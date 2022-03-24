from discord.ext import commands
import os
from dotenv import load_dotenv
import random
import discord


class Games(commands.Cog):
    def __init__(self, bot):
        self.bot = bot

    @commands.Cog.listener()
    async def on_command_error(self,ctx,ex):
        print(ex)
        await ctx.send('Check !help for commands')
#Coin flip
    @commands.command(brief='Flip a coin!')
    async def coin(self, ctx):
        
        flip = random.randint(0,1)
        if (flip == 0):
            await ctx.send('Heads!')
            
        elif (flip == 1):
            await ctx.send('Tails!')


#Rock paper scissors
    @commands.command(brief='Play rock paper scissors with bot')
    async def rps(self, ctx, arg):
        user_choice = arg
        rps_choices = ['Rock', 'Paper', 'Scissors']
        bot_choice = random.choice(rps_choices)
        
        if (user_choice == 'Rock'):
            if(bot_choice == 'Rock'):
                
                await ctx.send(f'Bot chose {bot_choice}, its a tie.')
            if(bot_choice == 'Paper'):
                await ctx.send(f'Bot chose {bot_choice}, you lost.')
            if(bot_choice == 'Scissors'):
                await ctx.send(f'Bot chose {bot_choice}, you win!')

        elif (user_choice == 'Paper'):
            if(bot_choice == 'Rock'):
                await ctx.send(f'Bot chose {bot_choice}, you win!')
            if(bot_choice == 'Paper'):
                await ctx.send(f'Bot chose {bot_choice}, its a tie.')
            if(bot_choice == 'Scissors'):
                await ctx.send(f'Bot chose {bot_choice}, you lost.')

        elif (user_choice == 'Scissors'):
            if(bot_choice == 'Rock'):
                await ctx.send(f'Bot chose {bot_choice}, you lost.')
            if(bot_choice == 'Paper'):
                await ctx.send(f'Bot chose {bot_choice}, you win!')
            if(bot_choice == 'Scissors'):
                await ctx.send(f'Bot chose {bot_choice}, its a tie.')
        
        elif (user_choice != 'Rock' and user_choice != 'Paper' and user_choice != 'Scissors'):
            await ctx.send('Usage: !rps [Rock/Paper/Scissors]')


#Dice
    @commands.command(brief='Roll a dice')
    async def dice(self, ctx):
        roll = random.randint(1,6)
        await ctx.send(f'You rolled {roll}')



def setup(bot):
    bot.add_cog(Games(bot))