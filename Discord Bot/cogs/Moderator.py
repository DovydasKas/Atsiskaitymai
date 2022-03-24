from sys import exc_info
from discord import message
from discord import client
from discord.client import Client
from discord.ext import commands
import os
from dotenv import load_dotenv
import random
import discord
from discord.ext.commands import has_permissions, MissingPermissions
import asyncio
from pymongo import MongoClient
import certifi

MONGO = os.getenv('MONGO')
mongoclientt = MongoClient("mongodb+srv://mongoUser:asdasd@cluster0.nsg0x.mongodb.net/DiscordBot?retryWrites=true&w=majority", tlsCAFile=certifi.where())
db = mongoclientt.get_database('DiscordBot')
Banned = db.get_collection('BannedUsers')
Muted = db.get_collection('MutedUsers')


class Moderator(commands.Cog):
    def __init__(self, bot):
        self.bot = bot

    @commands.Cog.listener()
    async def on_command_error(self,ctx,ex):
        print(ex)
        await ctx.send('Check !help for commands')

#Mute
    @commands.command(brief='Mute someone(Usage: !mute [nickname] [Reason] [Time(optional)])')
    @has_permissions(ban_members = True)
    async def mute(self, ctx, member: discord.Member, reason,*, mute_time : int = 0):
        guild = ctx.guild
        MutedRole = discord.utils.get(ctx.guild.roles, name='Muted')
        MemberRole = discord.utils.get(ctx.guild.roles, name='Member')
        if(reason == False):
            await ctx.send('Usage: !mute [nickname] [Reason] [Time(optional)]')
        else:
            await member.add_roles(MutedRole)
            await member.remove_roles(MemberRole)
            await member.send(f" you have been muted from: {guild.name} by {ctx.author} (Reason: {reason})")
            await ctx.channel.send(f'{member.mention} has been muted by {ctx.author.mention}(Reason:{reason})')
            post = {"_id": member.id, "name": member.display_name+'#'+member.discriminator, "reason": reason, "time": mute_time}
            Muted.insert_one(post)
            if(mute_time != 0):
                await asyncio.sleep(mute_time)
                await member.add_roles(MemberRole)
                await member.remove_roles(MutedRole)
                await ctx.channel.send(f'{member.mention} has been unmuted!')
                Muted.delete_one(post)
    @mute.error
    async def mute_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")

#Unmute
    @commands.command(brief='Unmute user (Usage: !unmute [nickname])')
    @has_permissions(ban_members = True)
    async def unmute(self, ctx, member: discord.Member):
        guild = ctx.guild
        MemberRole = discord.utils.get(ctx.guild.roles, name='Member')
        MutedRole = discord.utils.get(ctx.guild.roles, name='Muted')
        await member.add_roles(MemberRole)
        await member.remove_roles(MutedRole)
        await member.send(f" you have been unmuted from: {guild.name} by {ctx.author}")
        target = {"name": member.name+'#'+member.discriminator}
        Muted.delete_one(target)

    @unmute.error
    async def unmute_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")

#Kick
    @commands.command(brief='Kick someone(Usage: !kick [nickname] [Reason])')
    @has_permissions(ban_members = True)
    async def kick(self, ctx, member : discord.Member, *, reason=None):
        guild = ctx.guild
        await member.kick(reason=reason)
        await ctx.channel.send(f'{member.mention} has been kicked from the server by {ctx.author.mention}(Reason: {reason})')
    @kick.error
    async def kick_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")


#Ban
    @commands.command(brief='Ban someone(Usage: !ban [nickname] [Reason])')
    @has_permissions(ban_members = True)
    async def ban(self, ctx, member : discord.Member,*, reason=None):
        await member.ban(reason=reason)
        await ctx.channel.send(f'{member.mention} has been banned from the server by {ctx.author.mention}(Reason: {reason})')
        
        post = {"_id": member.id, "name": member.display_name+'#'+member.discriminator, "reason": reason}
        Banned.insert_one(post)
    @ban.error
    async def ban_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")


#Ban list
    @commands.command(brief='Shows list of banned users')
    @has_permissions(ban_members = True)
    async def bans(self,ctx):
        await ctx.send(f'Curently banned users: {Banned.count_documents({})}\n')
        usr = Banned.find()
        for i in usr:
            await ctx.send(f'{i["name"]} (Reason:{i["reason"]})\n')

    @bans.error
    async def bans_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")

#Unban
    @commands.command(brief='Unban user (Usage: !unban [User#Discriminator])')
    @has_permissions(ban_members = True)
    async def unban(self, ctx, *, member):
        banned_users = await ctx.guild.bans()
        member_name, member_discriminator = member.split('#')
        for ban_entry in banned_users:
            user = ban_entry.user
            if(user.name, user.discriminator) == (member_name, member_discriminator):
                await ctx.guild.unban(user)
                target = {"name": user.name+'#'+user.discriminator}
                Banned.delete_one(target)
                await ctx.channel.send(f'{ctx.author.mention} unbanned {user.mention}')

    @unban.error
    async def unban_error(self, ctx, error):
        if isinstance(error, MissingPermissions):
            await ctx.channel.send("You don't have permissions to do that!")


def setup(bot):
    bot.add_cog(Moderator(bot))