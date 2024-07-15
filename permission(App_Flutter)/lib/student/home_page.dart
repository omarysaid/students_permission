import 'package:curved_navigation_bar/curved_navigation_bar.dart';
import 'package:permission/student/profile.dart';
import 'package:permission/student/request.dart';
import 'package:permission/student/status.dart';
import 'package:flutter/material.dart';

class CurvedNavbar extends StatefulWidget {
  final String fullName;

  const CurvedNavbar({Key? key, required this.fullName}) : super(key: key);

  @override
  _CurvedNavbarState createState() => _CurvedNavbarState();
}

class _CurvedNavbarState extends State<CurvedNavbar> {
  int _currentIndex = 0;

  late List<Widget> _pages;

  @override
  void initState() {
    super.initState();
    _pages = [AddPermissionPage(fullName:widget.fullName),
      StatusPage(fullName: widget.fullName),
      Profile(),
    ];
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: AnimatedSwitcher(
        duration: Duration(milliseconds: 300),
        transitionBuilder: (Widget child, Animation<double> animation) {
          return FadeTransition(opacity: animation, child: child);
        },
        child: _pages[_currentIndex],
      ),
      bottomNavigationBar: CurvedNavigationBar(
        backgroundColor: Colors.transparent,
        buttonBackgroundColor: Colors.blue[800],
        color: Colors.blue.shade800,
        animationDuration: const Duration(milliseconds: 300),
        items: const <Widget>[
          Icon(Icons.add, size: 26, color: Colors.white),
          Icon(Icons.remove_red_eye_sharp, size: 26, color: Colors.white),
          Icon(Icons.person, size: 26, color: Colors.white),
        ],
        onTap: (index) {
          setState(() {
            _currentIndex = index;
          });
        },
      ),
    );
  }
}
