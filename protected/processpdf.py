#!/usr/bin/env python

import sys,os
import MySQLdb
import config

if len(sys.argv) != 2:
	print "Missing arg."
	exit(1)

con = MySQLdb.connect(host=config.mysql_host,user=config.mysql_user,passwd=config.mysql_password,port=config.mysql_port,charset=config.mysql_charset)
con.select_db(config.mysql_db)
cursor = con.cursor()
n = cursor.execute("SELECT RealFilename FROM "+config.table_name+" WHERE Id=%s LIMIT 1",(sys.argv[1]))
name = None
for row in cursor.fetchall():
    for r in row:
		name = r
if name == None:
	print "SQL Query Error:There is no such a Record."
	exit(1)
r = os.system(config.pdf2htmlEX_bin_dir+'pdf2htmlEX --dest-dir '+config.html_dir+'protected/tmp/ '+config.html_dir+'protected/resumes/'+name)
if r != 0:
	print "Run pdf2htmlEx error."
	exit(1)
mainname = name.split('.')
filename = config.html_dir+'protected/tmp/'+mainname[0]+'.html'
f = open(filename,'r')
allLines = f.readlines()
f.close
str = ''
for line in allLines:
	str = str + line
os.remove(filename)
cursor.execute('SET names utf8')
cursor.execute('UPDATE '+config.table_name+' SET Content="%s" WHERE Id=%s',(str,sys.argv[1]))
con.commit()
con.close()
