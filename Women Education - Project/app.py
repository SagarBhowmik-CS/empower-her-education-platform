from flask import Flask, render_template, request

app = Flask(__name__)

@app.route("/", methods=["GET", "POST"])
def login():
    if request.method == "POST":
        username = request.form.get("username")  # Get username from form
        if username:
            return f"<h1>Welcome @{username}</h1>"  # Print welcome message
        else:
            return "<h1>Please enter a username.</h1>"
    return render_template("login.html")  # Show the login page

if __name__ == "__main__":
    app.run(debug=True)  # Run the Flask app
