import 'package:permission/student/login.dart';
import 'package:flutter/material.dart';
// Import your LoginScreen widget

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false, // Remove debug banner
      title: 'Your App Name',
      theme: ThemeData(
        primarySwatch: Colors.teal,
      ),
      home: LoginScreen(),

    );
  }
}
