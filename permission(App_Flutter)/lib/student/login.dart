import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../config.dart';
import 'home_page.dart'; // Import HomePage if it exists
import 'register.dart';

class LoginScreen extends StatelessWidget {
  final TextEditingController emailController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  Future<void> loginUser(BuildContext context) async {
    const String url = '${Config.baseUrl}/login.php'; // Update with your PHP server URL
    final response = await http.post(
      Uri.parse(url),
      headers: <String, String>{
        'Content-Type': 'application/json; charset=UTF-8',
      },
      body: jsonEncode(<String, String>{
        'email': emailController.text,
        'password': passwordController.text,
      }),
    );

    if (response.statusCode == 200) {
      final responseData = json.decode(response.body);
      if (responseData['success']) {
        // Save user data to SharedPreferences
        SharedPreferences prefs = await SharedPreferences.getInstance();
        await prefs.setString('fullName', responseData['fullName'] ?? '');
        await prefs.setString('email', responseData['email'] ?? '');
        await prefs.setString('regNo', responseData['regNo'] ?? ''); // Handle null regNo
        await prefs.setString('yearOfStudy', responseData['yearOfStudy'] ?? ''); // Handle null yearOfStudy
        await prefs.setString('Course', responseData['Course'] ?? ''); // Handle null Course
        await prefs.setString('Dept', responseData['Dept'] ?? ''); // Handle null Dept
        await prefs.setString('School', responseData['School'] ?? ''); // Handle null School

        // Navigate to HomePage or CurvedNavbar on successful login
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(builder: (context) => CurvedNavbar(fullName: responseData['fullName'] ?? '')), // Replace with your actual home screen
        );

        // Show green toast for success
        Fluttertoast.showToast(
          msg: responseData['message'],
          backgroundColor: Colors.green,
        );
      } else {
        // Show error message on failed login
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(responseData['message']),
            backgroundColor: Colors.red, // Show red snackbar for error
          ),
        );
      }
    } else {
      // Show error message on server error
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Failed to connect to server.'),
          backgroundColor: Colors.red, // Show red snackbar for error
        ),
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.blue[800], // Set scaffold background color to blue
      body: SingleChildScrollView(
        child: Container(
          height: MediaQuery.of(context).size.height,
          child: Column(
            children: [
              Spacer(flex: 1),
              Padding(
                padding: const EdgeInsets.only(top: 50.0),
                child: ClipRRect(
                  borderRadius: BorderRadius.circular(75.0), // Apply a circular radius
                  child: Image.asset(
                    'assets/images/logoo.jpg',
                    height: 150,
                  ),
                ),
              ),
              const SizedBox(height: 10.0),
              Text(
                'Students Permission',
                style: TextStyle(
                  fontSize: 30.0,
                  fontWeight: FontWeight.bold,
                  color: Colors.white,
                ),
              ),
              Spacer(flex: 1),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 20.0),
                child: Container(
                  height: MediaQuery.of(context).size.height * 0.5,
                  child: ClipPath(
                    clipper: MyCustomClipper(),
                    child: Container(
                      width: double.infinity,
                      decoration: BoxDecoration(
                        color: Colors.blue[800],
                      ),
                      padding: const EdgeInsets.all(20.0),
                      child: Column(
                        mainAxisSize: MainAxisSize.min,
                        children: [
                          Text(
                            'Sign In Here',
                            style: TextStyle(
                              fontSize: 20.0,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                          const SizedBox(height: 20.0),
                          TextField(
                            controller: emailController,
                            decoration: InputDecoration(
                              filled: true,
                              fillColor: const Color(0xFFF0F0F0),
                              hintText: 'Email',
                              prefixIcon: const Icon(Icons.email, color: Colors.black),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                              enabledBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                              focusedBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                            ),
                          ),
                          const SizedBox(height: 20.0),
                          TextField(
                            controller: passwordController,
                            obscureText: true,
                            decoration: InputDecoration(
                              filled: true,
                              fillColor: const Color(0xFFF0F0F0),
                              hintText: 'Password',
                              prefixIcon: const Icon(Icons.lock, color: Colors.black),
                              border: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                              enabledBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                              focusedBorder: OutlineInputBorder(
                                borderRadius: BorderRadius.circular(30.0),
                                borderSide: const BorderSide(color: Colors.teal),
                              ),
                            ),
                          ),
                          const SizedBox(height: 20.0),
                          ElevatedButton(
                            onPressed: () {
                              // Handle login logic
                              loginUser(context);
                            },
                            style: ElevatedButton.styleFrom(
                              backgroundColor: Color(0xFFFF6347),
                              padding: const EdgeInsets.symmetric(horizontal: 130, vertical: 20),
                            ),
                            child: const Text(
                              'Login',
                              style: TextStyle(
                                fontSize: 18.0,
                                color: Colors.white,
                              ),
                            ),
                          ),
                          TextButton(
                            onPressed: () {
                              Navigator.push(
                                context,
                                MaterialPageRoute(builder: (context) => SignUpScreen()),
                              );
                            },
                            child: const Text(
                              'Don\'t have an account? Register here',
                              style: TextStyle(
                                color: Colors.white,
                                fontSize: 20.0,
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
              ),
              Spacer(flex: 1),
            ],
          ),
        ),
      ),
    );
  }
}

class MyCustomClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    var path = Path();
    path.lineTo(0, size.height - 100);
    path.quadraticBezierTo(size.width / 2, size.height, size.width, size.height - 100);
    path.lineTo(size.width, 0);
    path.close();
    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}


