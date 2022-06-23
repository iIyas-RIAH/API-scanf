import cv2
import sys

import faceRecognition as fr

classe = sys.argv[1]
photo = sys.argv[2]
list = sys.argv[3]

path = "Media/AbsImage/PreAbs/"+str(photo)

names = list.split(';')

img = cv2.imread(photo)  # Give path to the image which you want to test

faces_detected, gray_img = fr.faceDetection(img)

face_recognizer = cv2.face.LBPHFaceRecognizer_create()
face_recognizer.read('YAMLFiles/' + str(classe) + '.yml')  # Give path of where trainingData.yml is saved

liste_presence = []

for face in faces_detected:
    (x, y, w, h) = face
    roi_gray = gray_img[y:y + h, x:x + h]
    label_id, confidence = face_recognizer.predict(roi_gray)
    if confidence < 60:
        fr.draw_rect(img, face)
        predicted_name = names[label_id]
        liste_presence.append(predicted_name)
        fr.put_text(img, predicted_name, x, y)
    else:
        predicted_name = "Inconnu"
        fr.others(img, predicted_name, face)

cv2.imwrite("../AbsImage/PostAbs/"+photo, img)

cv2.destroyAllWindows()
return liste_presence
