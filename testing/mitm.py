import sys

# global history
# history = []

def request(flow):
	f = open('httplogs.txt', 'a+')
	f.write(flow.request.method + ' ' + flow.request.url +'\n')
	f.write(flow.request.headers.get("cookie") +'\n')
	f.close()

def response(flow):
	f = open('httplogs.txt', 'a+')
	f.write(str(flow.response.status_code) + '\n')
	f.write(flow.request.headers.get("cookie") +'\n')
	f.write('\n')
	f.close()
