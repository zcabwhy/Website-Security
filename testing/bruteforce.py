import requests
from threading import Thread
import sys
import getopt

class request_performer(Thread):
    def __init__( self,word,url):
        Thread.__init__(self)
        try:
            self.word = word.split("\n")[0]
            self.urly = url.replace('DUMMY',self.word)
            self.url = self.urly
        except Exception as e:
            print (e)

    def run(self):
        try:
            r = requests.get(self.url)
            if r.status_code != 404:
                print (self.url + " - " + str(r.status_code))
            i[0]=i[0]-1 #Here we remove one thread from the counter
        except Exception as e:
                print (e)

def start(argv):
    if len(sys.argv) < 5:
           sys.exit()
    try :
        opts, args = getopt.getopt(argv,"w:f:t:")
    except getopt.GetoptError:
               sys.exit()

    for opt,arg in opts :
           if opt == '-w' :
                   url=arg
           elif opt == '-f':
                   dict= arg
           elif opt == '-t':
                   threads=arg
    try:
           f = open(dict, "r")
           words = f.readlines()
    except:
           print ("Failed opening file: "+ dict+"\n")
           sys.exit()
           
    launcher_thread(words,threads,url)

def launcher_thread(names,th,url):
    global i
    i=[]
    resultlist=[]
    i.append(0)
    while len(names):
        try:
            if i[0]< int(th):
                n = names.pop(0)
                i[0]=i[0]+1
                thread=request_performer(n,url)
                thread.start()

        except KeyboardInterrupt:
            print ("Brute forcer interrupted  by user. Finishing attack..")
            sys.exit()
        thread.join()
    return

if __name__ == "__main__":
    try:
        start(sys.argv[1:])
    except KeyboardInterrupt:
        print ("Brute forcer interrupted by user, killing all threads..!!")
