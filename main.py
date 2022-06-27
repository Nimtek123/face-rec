# USAGE
# python recognize_faces_image.py --encodings encodings.pickle --image examples/example_01.png 

# import the necessary packages
import face_recognition
import argparse
import pickle
import cv2
import sys
import datetime
import time
import csv
import requests
import base64
import numpy as np
from flask import Flask, render_template, request
import json
import ssl
import urllib
from urllib.request import urlopen



app = Flask(__name__)
port = 5100

@app.route('/')
def hello():
	return render_template('index.html')

@app.route('/face_rec', methods=['POST'])
def face_rec():
	url = request.form['imgUrl']
	# construct the argument parser and parse the arguments
	# ap = argparse.ArgumentParser()
	# ap.add_argument("-e", "--encodings", required=True,
	# 	help="path to serialized db of facial encodings")
	# ap.add_argument("-i", "--image", required=True,
	# 	help="path to input image")
	# ap.add_argument("-d", "--detection-method", type=str, default="cnn",
	# 	help="face detection model to use: either `hog` or `cnn`")
	# args = vars(ap.parse_args())

	# load the known faces and embeddings
	print("[INFO] loading encodings...")
	data = pickle.loads(open('encodings.pickle', "rb").read())

	# load the input image and convert it from BGR to RGB
	# imageFile =  str(sys.argv[1])
	# image = cv2.imread('camera_images/'+ str(imageFile))
	context = ssl._create_unverified_context()
	url_response = urllib.request.urlopen(url, context=context)
	img_array = np.array(bytearray(url_response.read()), dtype=np.uint8)
	image = cv2.imdecode(img_array, -1)
	rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)

	# detect the (x, y)-coordinates of the bounding boxes corresponding
	# to each face in the input image, then compute the facial embeddings
	# for each face
	print("[INFO] recognizing faces...")
	boxes = face_recognition.face_locations(rgb,
		model='cnn')
	encodings = face_recognition.face_encodings(rgb, boxes)

	# initialize the list of names for each face detected
	names = []
	matchedCounts = {}
	post_data = {}
	# loop over the facial embeddings
	for encoding in encodings:
		# attempt to match each face in the input image to our known
		# encodings
		matches = face_recognition.compare_faces(data["encodings"],
			encoding)
		name = "Unknown"
		counts = {}

		# check to see if we have found a match
		if True in matches:
			# find the indexes of all matched faces then initialize a
			# dictionary to count the total number of times each face
			# was matched
			matchedIdxs = [i for (i, b) in enumerate(matches) if b]
			

			# loop over the matched indexes and maintain a count for
			# each recognized face face
			for i in matchedIdxs:
				name = data["names"][i]
				counts[name] = counts.get(name, 0) + 1

			# determine the recognized face with the largest number of
			# votes (note: in the event of an unlikely tie Python will
			# select first entry in the dictionary)
			name = max(counts, key=counts.get)

		
		# update the list of names
		names.append(name)
		matchedCounts[name] = counts[name]
	date_post = str(datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"))
	image_data = ''
	# with open('camera_images/'+imageFile, "rb") as f:
	# 		#data = f.read()												
	# 		image_data =  base64.b64encode(f.read())#data.encode("base64")

	for name in names:
		y = np.array(data["names"])
		totalImages =np.count_nonzero(y == name)
		print("matched people " +name)

		file = open("matched.csv","a") 
		file.write("match found;"+name +";suspect;" + date_post+ ";"+ "matched "+str(matchedCounts[name])+" of " +str(totalImages) + " Images"+"\n") 
		file.close() 

		#post image and name for phone notification
		post_data = {"img_name":name, "matchedCounts": matchedCounts[name], "Total User images": str(totalImages),  "date":date_post}
		
		
	return json.dumps(post_data)
		# POST some form-encoded data:
		#post_response = requests.post(url='https://whois.nitstack.co.za/facialrecognition/whois.php', data=post_data)
		
	# fd.close()

	# loop over the recognized faces
	# for ((top, right, bottom, left), name) in zip(boxes, names):
	# 	# draw the predicted face name on the image
	# 	cv2.rectangle(image, (left, top), (right, bottom), (0, 255, 0), 2)
	# 	y = top - 15 if top - 15 > 15 else top + 15
	# 	cv2.putText(image, name, (left, y), cv2.FONT_HERSHEY_SIMPLEX,
	# 		0.75, (0, 255, 0), 2)

	# show the output image
	# cv2.imshow("Image", image)
	# cv2.waitKey(0)

if __name__ == "__main__":
	app.run(debug=True)