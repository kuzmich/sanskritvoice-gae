from paste.deploy import loadapp


import sys
from pprint import pprint
#pprint(sys.path)
#print(sys.prefix)


app = loadapp('config:sv/development.ini', relative_to='.')
