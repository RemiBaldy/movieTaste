
# import socket programming library 
import socket 
from subprocess import Popen, PIPE
from pathlib import Path
import traceback
import struct
import sys
  
# import thread module 
from _thread import *
import threading 
  
print_lock = threading.Lock() 

# thread fuction 
def threaded(c):
    print("YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY")
    #c.send("issou".encode("ascii")) 
    while True: 
  
        # data received from client 
        data = c.recv(1024)
        print("DATA_MAIN "+data.decode('ascii')) 
        if not data: 
            print('Bye') 
              
            # lock released on exit 
            print_lock.release() 
            break
        
            

        msgDecoded = str(data.decode('ascii'))
        print("ooooh "+msgDecoded)
        msgSplit = msgDecoded.split(":")
        print("ahhhhhh"+msgSplit[0])
        output = "error".encode('ascii')

        if(msgSplit[0] == "userId"):
            arg_identUser = msgSplit[1]
            arg_filename="recommandation"
            my_file = Path(arg_filename+".py")
            
            if my_file.is_file():
                output = "no valid output."
                proc = Popen(["/usr/bin/python3", arg_filename+".py",arg_identUser], shell=False, stdout=PIPE, stderr=PIPE )
                print("je ne suis pas encore passe")
                output = proc.communicate()[0]
                print("Je suis passe")
         
        # reverse the given string from client 
        #data = data[::-1] 
  
        # send back reversed string to client 
        #send_msg(c,data)
        #output = "error".encode('ascii')
        c.send(output)
        print("output du serv "+output.decode('ascii'))
        #c.close()
        print_lock.release()
        break;
    # connection closed 
    c.close() 
  
  
def Main(): 
    host = "" 
  
    # reverse a port on your computer 
    # in our case it is 12345 but it 
    # can be anything 
    port = int(sys.argv[1])
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM) 
    s.bind((host, port)) 
    print("socket binded to post", port) 
  
    # put the socket into listening mode 
    s.listen(5) 
    print("socket is listening") 
  
    # a forever loop until client wants to exit 
    while True: 
        print("En attente de connexion")
        # establish connection with client 
        c, addr = s.accept() 
        print("Connexion bloqué")
        # lock acquired by client 
        print_lock.acquire() 
        print('Connected to :', addr[0], ':', addr[1]) 
  
        # Start a new thread and return its identifier 
        start_new_thread(threaded, (c,))
    print("ca degage") 
    s.close() 
  
  
if __name__ == '__main__': 
    Main() 

