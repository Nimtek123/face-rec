#! /usr/bin/python3.9
import sys
import logging
logging.basicConfig(stream=sys.stderr)
sys.path.insert(0,"/var/www/facerec/")

from main import app as application
application.secret_key = '123456789'
