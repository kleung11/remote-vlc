#!/usr/bin/env python3
"""
loadDB <new_file>
"""
import argparse
import os
import sys
import re
import mysql.connector
from pathlib import Path

from subprocess import check_call

###### INIT ######
db_servername = "127.0.0.1";
# db_port = "3306";
db_username = "root";
db_password = "karaoke";
db_name = "kko";

# finds the root directory
# NOTE: assumes this is run inside the project
def root_dir():
    here = os.getcwd()
    path = here.split(os.sep)
    parts = []

    for el in path:
        parts.append(el)

        if el == 'remote-vlc':
            break

    return os.sep.join(parts)


sys.path.append(root_dir() + '/python')

# load all songs via directory
def load_all(directory):
    cnx = mysql.connector.connect(user=db_username, password=db_password,
                                  host=db_servername,
                                  database=db_name)
    cursor = cnx.cursor()

    print('loading all songs')
    count = 0
    for path in Path(directory).rglob('*.*'):
        song_name, singer = parse_name(path)
        add_song = ("INSERT INTO songs "
                        "(singer, song_name, song_location) "
                        "VALUES (%s, %s, %s)")
        song_data = (singer, song_name, str(path))
        cursor.execute(add_song, song_data)

        count = count + 1
        if count % 1000 == 0:
            print("loaded", count)
    
    print('loading complete with', count, ' songs done')
    cnx.commit()
    cnx.close()

def load_single_file(filename):
    # make sure it's a valid file
    path = Path(filename)
    if not path.is_file():
        print("input is not a valid file")
        return

    cnx = mysql.connector.connect(user=db_username, password=db_password,
                                  host=db_servername,
                                  database=db_name)
    cursor = cnx.cursor()

    song_name, singer = parse_name(path)
    add_song = ("INSERT INTO songs "
                    "(singer, song_name, song_location) "
                    "VALUES (%s, %s, %s)")
    song_data = (singer, song_name, str(path))
    cursor.execute(add_song, song_data)

    cnx.commit()
    cnx.close()    
    print('loading single song done')

# parse name out of the filename
def parse_name(path):
    name = re.sub(r'_', " ", path.name)
    song_name = re.sub(r'(.*)-(.*)\..*', r'\2', name)
    singer = re.sub(r'(.*)-(.*)', r'\1', name)

    return song_name, singer

if __name__ == '__main__':
    parser = argparse.ArgumentParser(description='load all songs into db or one song via path and filename')
    parser.add_argument("-a", "--all",     action='store', help='load all in default directory or by provided directory')
    parser.add_argument("-i", "--input",   action='store', help='add one song by absolute filename')
    args = parser.parse_args()

    if args.all:
        directory = '/Volumes/songs/KKOdata'
        if args.all != 'ALL':
            directory = args.all
        load_all(directory)
    elif args.input:
        load_single_file(args.input)
    else:
        print('invalid argument') # TODO: print usage
