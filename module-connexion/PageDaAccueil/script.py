from flask import Flask, jsonify
from sketchpy import library

app = Flask(__name__)

@app.route('/draw')
def draw():
    obj = library.rdj()
    result = obj.draw()
    return jsonify(result=result)

if __name__ == '__main__':
    app.run()
