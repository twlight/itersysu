#!/usr/bin/env python

import sys,os
import MySQLdb
import re
import base64
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
r = os.system(config.unoconv_bin_dir+'unoconv -f html -o '+config.html_dir+'protected/tmp/ '+config.html_dir+'protected/resumes/'+name)
if r != 0:
	print "Run unoconv error."+name
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
list = re.findall(mainname[0]+'_html_.*jpg',str)
for item in list:
	fn = config.html_dir+'protected/tmp/'+item
	fp = open(fn,'rb')
	try:
		text = fp.read()
	finally:
		fp.close()
	en = base64.b64encode(text)
	str = str.replace(item,'data:image/jpeg;base64,'+en)
	os.remove(fn)
list = re.findall(mainname[0]+'_html_.*png',str)
for item in list:
	fn = config.html_dir+'protected/tmp/'+item
	fp = open(fn,'rb')
	try:
		text = fp.read()
	finally:
		fp.close()
	en = base64.b64encode(text)
	str = str.replace(item,'data:image/png;base64,'+en)
	os.remove(fn)
list = re.findall(mainname[0]+'_html_.*gif',str)
for item in list:
	fn = config.html_dir+'protected/tmp/'+item
	fp = open(fn,'rb')
	try:
		text = fp.read()
	finally:
		fp.close()
	en = base64.b64encode(text)
	str = str.replace(item,'data:image/gif;base64,'+en)
	os.remove(fn)
cursor.execute('UPDATE '+config.table_name+' SET Content="%s" WHERE Id=%s',(str,sys.argv[1]))
con.commit()
con.close()
