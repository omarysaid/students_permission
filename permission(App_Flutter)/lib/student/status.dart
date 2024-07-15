import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../config.dart';

class StatusPage extends StatefulWidget {
  final String fullName;

  StatusPage({required this.fullName});

  @override
  _StatusPageState createState() => _StatusPageState();
}

class _StatusPageState extends State<StatusPage> {
  late Future<List<Permission>> permissions;

  @override
  void initState() {
    super.initState();
    permissions = fetchPermissions(widget.fullName);
  }

  Future<List<Permission>> fetchPermissions(String fullName) async {
    final response = await http.get(
      Uri.parse('${Config.baseUrl}/status.php?fullName=$fullName'),
      headers: {
        "Content-Type": "application/json",
      },
    );

    if (response.statusCode == 200) {
      final jsonResponse = json.decode(response.body);
      if (jsonResponse['success']) {
        List permissionsJson = jsonResponse['permissions'];
        return permissionsJson.map((permission) => Permission.fromJson(permission)).toList();
      } else {
        throw Exception('Failed to load permissions: ${jsonResponse['message']}');
      }
    } else {
      throw Exception('Failed to load permissions');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Permission Status',
          style: TextStyle(
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        centerTitle: true,
        flexibleSpace: Container(
          decoration: BoxDecoration(
            gradient: LinearGradient(
              colors: [Colors.blue.shade800, Colors.blue.shade600],
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
            ),
            borderRadius: BorderRadius.vertical(
              bottom: Radius.circular(10),
            ),
          ),
        ),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.vertical(
            bottom: Radius.circular(30),
          ),
        ),
        automaticallyImplyLeading: false,
      ),
      body: FutureBuilder<List<Permission>>(
        future: permissions,
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('No permissions found'));
          } else {
            return ListView(
              children: [
                Card(
                  color: Color(0xFFFF6347),
                  margin: EdgeInsets.all(15),
                  elevation: 5,
                  child: Padding(
                    padding: const EdgeInsets.all(15.0),
                    child: Row(
                      children: [
                        CircleAvatar(
                          radius: 30,
                          backgroundImage: AssetImage('assets/images/logoo.jpg'), // Replace with your asset image
                        ),
                        SizedBox(width: 20),
                        Expanded(
                          child: Text(
                            'Welcome, ${widget.fullName}',
                            style: TextStyle(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
                ...snapshot.data!.map((permission) => Card(
                  color: Color(0xFFFF6347),
                  margin: EdgeInsets.symmetric(vertical: 10, horizontal: 15),
                  elevation: 5,
                  child: Padding(
                    padding: const EdgeInsets.all(15.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Permission ${snapshot.data!.indexOf(permission) + 1}',
                          style: TextStyle(
                            fontWeight: FontWeight.bold,
                            fontSize: 18,
                            color: Colors.white,
                          ),
                        ),
                        SizedBox(height: 10),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                          children: [
                            _buildStatusCircle(permission.approveForDirOfStuService, 'Director of \n students service'),
                            _buildStatusCircle(permission.approveForHoD, 'Head of \n  Depertment.'),
                            _buildStatusCircle(permission.approveForDeanOfSchl, 'Dean of \n School'),
                          ],
                        ),
                      ],
                    ),
                  ),
                )).toList(),
              ],
            );
          }
        },
      ),
    );
  }

  Widget _buildStatusCircle(String? status, String label) {
    bool isApproved = status != null && status.isNotEmpty;
    return Column(
      children: [
        Container(
          width: 50,
          height: 50,
          decoration: BoxDecoration(
            shape: BoxShape.circle,
            color: Colors.white,
          ),
          child: Center(
            child: Icon(
              isApproved ? Icons.check : Icons.close,
              color: isApproved ? Colors.green : Colors.red,
            ),
          ),
        ),
        SizedBox(height: 5),
        Text(
          label,
          style: TextStyle(color: Colors.white, fontSize: 12),
          textAlign: TextAlign.center,
        ),
      ],
    );
  }
}

class Permission {
  final String? approveForDirOfStuService;
  final String? approveForHoD;
  final String? approveForDeanOfSchl;

  Permission({
    required this.approveForDirOfStuService,
    required this.approveForHoD,
    required this.approveForDeanOfSchl,
  });

  factory Permission.fromJson(Map<String, dynamic> json) {
    return Permission(
      approveForDirOfStuService: json['approveForDirOfStuService'],
      approveForHoD: json['approveForHoD'],
      approveForDeanOfSchl: json['approveForDeanOfSchl'],
    );
  }
}