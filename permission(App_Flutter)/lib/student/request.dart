import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';

import '../config.dart';

class AddPermissionPage extends StatefulWidget {
  final String fullName;

  const AddPermissionPage({Key? key, required this.fullName}) : super(key: key);

  @override
  _AddPermissionPageState createState() => _AddPermissionPageState();
}

class _AddPermissionPageState extends State<AddPermissionPage> {
  TextEditingController regNoController = TextEditingController();
  TextEditingController courseController = TextEditingController();
  TextEditingController daysController = TextEditingController();
  TextEditingController departingOnController = TextEditingController();
  TextEditingController returningOnController = TextEditingController();
  TextEditingController reasonForController = TextEditingController();
  TextEditingController phoneNumberController = TextEditingController();
  TextEditingController dateController = TextEditingController();
  TextEditingController fullNameController = TextEditingController();

  String? selectedYearOfStudy;
  String? selectedDepartment;
  String? selectedSchool;

  bool isLoading = false;

  final List<String> yearOptions = [
    '--Select year of study---',
    'Year One',
    'Year Two',
    'Year Three',
    'Year Four',
    'Year Five'
  ];

  final List<String> departmentOptions = [
    'Select Department',
    'Building Economics',
    'Architecture',
    'Interior Design',
    'Geospatial Sciences and Technology',
    'Computer Systems and Mathematics',
    'Business Studies',
    'Land Management and Valuation',
    'Civil and Environmental Engineering',
    'Environmental Science and Management',
    'Urban and Regional Planning',
    'Economics and Social Studies'
  ];

  final List<String> schoolOptions = [
    '--Select School---',
    'SACEM',
    'SSPSS',
    'SERBI',
    'SEES',

  ];

  @override
  void initState() {
    super.initState();
    fullNameController.text = widget.fullName; // Autofill full name
  }

  void _showToastMessage(String message, [bool isSuccess = false]) {
    Fluttertoast.showToast(
      msg: message,
      toastLength: Toast.LENGTH_SHORT,
      gravity: ToastGravity.BOTTOM,
      backgroundColor: isSuccess ? Colors.green : Colors.red,
      textColor: Colors.white,
    );
  }

  Future<void> _submitPermissionDetails() async {
    if (isLoading) return;
    setState(() {
      isLoading = true;
    });

    try {
      if (_validateForm()) {
        final success = await _submitForm();
        _showToastMessage(success['message'], success['status'] == 'success');
      } else {
        _showToastMessage('All fields are required');
      }
    } finally {
      setState(() {
        isLoading = false;
      });
    }
  }

  bool _validateForm() {
    return regNoController.text.isNotEmpty &&
        selectedYearOfStudy != null &&
        selectedYearOfStudy != '--Select year of study---' &&
        courseController.text.isNotEmpty &&
        selectedDepartment != null &&
        selectedDepartment != 'Select Department' &&
        selectedSchool != null &&
        selectedSchool != '--Select School---' &&
        daysController.text.isNotEmpty &&
        departingOnController.text.isNotEmpty &&
        returningOnController.text.isNotEmpty &&
        reasonForController.text.isNotEmpty &&
        phoneNumberController.text.isNotEmpty &&
        dateController.text.isNotEmpty;
  }

  Future<Map<String, dynamic>> _submitForm() async {
    try {
      const url = '${Config.baseUrl}/request.php';
      var response = await http.post(
        Uri.parse(url),
        headers: {
          "Content-Type": "application/json",
        },
        body: json.encode({
          'fullName': fullNameController.text,
          'regNo': regNoController.text,
          'yearOfStudy': selectedYearOfStudy,
          'Course': courseController.text,
          'Dept': selectedDepartment,
          'School': selectedSchool,
          'days': daysController.text,
          'departingOn': departingOnController.text,
          'returningOn': returningOnController.text,
          'reasonFor': reasonForController.text,
          'phoneNumber': phoneNumberController.text,
          'date': dateController.text,
        }),
      );

      var responseJson = json.decode(response.body);
      return responseJson;
    } catch (e) {
      print('Error submitting form: $e'); // Print or log the error
      return {
        'status': 'error',
        'message': 'An unknown error occurred',
      };
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey[200],
      appBar: AppBar(
        title: Text(
          'Permission Request',
          style: TextStyle(
            fontWeight: FontWeight.bold,
            color: Colors.white,
          ),
        ),
        centerTitle: true,
        flexibleSpace: Container(
          decoration: BoxDecoration(
            gradient: LinearGradient(
              colors: [Colors.blue.shade800, Colors.blue.shade800],
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
      body: SingleChildScrollView(
        child: Padding(
          padding: EdgeInsets.all(20.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.stretch,
            children: [
              SizedBox(height: 20.0),
              TextFormField(
                controller: fullNameController,
                decoration: InputDecoration(
                  labelText: 'Full Name',
                  prefixIcon: Icon(Icons.person),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
                readOnly: true, // Make it read-only
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: regNoController,
                decoration: InputDecoration(
                  labelText: 'Registration Number',
                  prefixIcon: Icon(Icons.assignment_ind),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              DropdownButtonFormField<String>(
                value: selectedYearOfStudy,
                onChanged: (value) {
                  setState(() {
                    selectedYearOfStudy = value;
                  });
                },
                items: yearOptions.map((year) {
                  return DropdownMenuItem<String>(
                    value: year,
                    child: Text(year),
                  );
                }).toList(),
                decoration: InputDecoration(
                  labelText: 'Year of Study',
                  prefixIcon: Icon(Icons.school),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              DropdownButtonFormField<String>(
                value: selectedDepartment,
                onChanged: (value) {
                  setState(() {
                    selectedDepartment = value;
                  });
                },
                items: departmentOptions.map((dept) {
                  return DropdownMenuItem<String>(
                    value: dept,
                    child: Text(dept),
                  );
                }).toList(),
                decoration: InputDecoration(
                  labelText: 'Department',
                  prefixIcon: Icon(Icons.domain),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              DropdownButtonFormField<String>(
                value: selectedSchool,
                onChanged: (value) {
                  setState(() {
                    selectedSchool = value;
                  });
                },
                items: schoolOptions.map((school) {
                  return DropdownMenuItem<String>(
                    value: school,
                    child: Text(school),
                  );
                }).toList(),
                decoration: InputDecoration(
                  labelText: 'School',
                  prefixIcon: Icon(Icons.location_city),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: courseController,
                decoration: InputDecoration(
                  labelText: 'Course',
                  prefixIcon: Icon(Icons.book),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: daysController,
                keyboardType: TextInputType.number,
                decoration: InputDecoration(
                  labelText: 'Number of Days',
                  prefixIcon: Icon(Icons.calendar_today),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: departingOnController,
                decoration: InputDecoration(
                  labelText: 'Departing On',
                  prefixIcon: Icon(Icons.date_range),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
                onTap: () async {
                  DateTime? pickedDate = await showDatePicker(
                    context: context,
                    initialDate: DateTime.now(),
                    firstDate: DateTime(2000),
                    lastDate: DateTime(2101),
                  );

                  if (pickedDate != null) {
                    setState(() {
                      departingOnController.text =
                      "${pickedDate.day}/${pickedDate.month}/${pickedDate.year}";
                    });
                  }
                },
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: returningOnController,
                decoration: InputDecoration(
                  labelText: 'Returning On',
                  prefixIcon: Icon(Icons.date_range),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
                onTap: () async {
                  DateTime? pickedDate = await showDatePicker(
                    context: context,
                    initialDate: DateTime.now(),
                    firstDate: DateTime(2000),
                    lastDate: DateTime(2101),
                  );

                  if (pickedDate != null) {
                    setState(() {
                      returningOnController.text =
                      "${pickedDate.day}/${pickedDate.month}/${pickedDate.year}";
                    });
                  }
                },
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: reasonForController,
                maxLines: 3,
                decoration: InputDecoration(
                  labelText: 'Reason For',
                  prefixIcon: Icon(Icons.message),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: phoneNumberController,
                keyboardType: TextInputType.phone,
                decoration: InputDecoration(
                  labelText: 'Phone Number',
                  prefixIcon: Icon(Icons.phone),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0),
              TextFormField(
                controller: dateController,
                decoration: InputDecoration(
                  labelText: 'Date',
                  prefixIcon: Icon(Icons.date_range),
                  border: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(10.0),
                    borderSide: BorderSide(
                      color: Colors.blue.shade800,
                      width: 2.0,
                    ),
                  ),
                ),
                onTap: () async {
                  DateTime? pickedDate = await showDatePicker(
                    context: context,
                    initialDate: DateTime.now(),
                    firstDate: DateTime(2000),
                    lastDate: DateTime(2101),
                  );

                  if (pickedDate != null) {
                    setState(() {
                      dateController.text =
                      "${pickedDate.day}/${pickedDate.month}/${pickedDate.year}";
                    });
                  }
                },
              ),
              SizedBox(height: 30.0),
              ElevatedButton(
                onPressed: isLoading ? null : _submitPermissionDetails,
                style: ElevatedButton.styleFrom(
                  padding: EdgeInsets.symmetric(vertical: 16.0), backgroundColor: Colors.blue.shade800,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(10.0),
                  ),
                ),
                child: isLoading
                    ? CircularProgressIndicator(
                  valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                )
                    : Text(
                  'Submit',
                  style: TextStyle(
                    fontWeight: FontWeight.bold,
                    fontSize: 18.0,
                  ),
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
