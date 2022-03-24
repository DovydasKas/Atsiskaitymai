from discord import client
from discord.ext import commands
import os
from dotenv import load_dotenv
import random
import discord

intents = discord.Intents.all()
intents.members=True
client = discord.Client(intents=intents)

load_dotenv()
TOKEN = os.getenv('DISCORD_TOKEN')
bot = commands.Bot(command_prefix='!', intents = discord.Intents.all())
GUILD = os.getenv('GUILD')


@bot.event
async def on_ready():
    print('Ready')

@bot.event
async def on_member_join(member):
    
    MemberRole = discord.utils.get(member.guild.roles, name='Member')
    await member.send(f'{member}, welcome to the server!\nYou can find all commands using !help')
    await member.add_roles(MemberRole)


for filename in os.listdir('./cogs'):
    if filename.endswith('.py') and filename != '__init__.py':
        bot.load_extension(f'cogs.{filename[:-3]}')

bot.run(TOKEN)