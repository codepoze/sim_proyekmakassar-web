import 'package:aaa/auth/forgot_password/view.dart';
import 'package:aaa/components/footer.dart';
import 'package:aaa/pages/home.dart';
import 'package:flutter/material.dart';

class SignIn extends StatefulWidget {
  @override
  State<SignIn> createState() => _SignInState();
}

class _SignInState extends State<SignIn> {
  _signInScreen() {
    return Scaffold(
      body: Center(
          child: ListView(shrinkWrap: true, children: <Widget>[
        Container(margin: EdgeInsets.only(top: 30), alignment: Alignment.center, child: Image.asset('assets/images/logo/logo.png', width: 100)),
        Card(
            margin: EdgeInsets.all(30),
            elevation: 3,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
            child: Padding(
                padding: EdgeInsets.all(40),
                child: Column(children: <Widget>[
                  Container(
                      padding: EdgeInsets.only(bottom: 30),
                      child: Text('SIGN IN', style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Color(0xFFF6CB00)))),
                  TextField(
                      keyboardType: TextInputType.emailAddress,
                      decoration: InputDecoration(
                          labelText: 'Email',
                          labelStyle: TextStyle(color: Colors.black87),
                          prefixIcon: Icon(Icons.mail, color: Color(0xFFF6CB00)),
                          contentPadding: EdgeInsets.fromLTRB(20, 10, 0, 10),
                          focusedBorder: OutlineInputBorder(
                            borderRadius: BorderRadius.circular(25),
                            borderSide: BorderSide(width: 2, color: Color(0xFFF6CB00)),
                          ),
                          enabledBorder:
                              OutlineInputBorder(borderRadius: BorderRadius.circular(25), borderSide: BorderSide(color: Color(0xFFF6CB00))))),
                  SizedBox(height: 10),
                  TextField(
                      obscureText: true,
                      decoration: InputDecoration(
                          labelText: 'Password',
                          labelStyle: TextStyle(color: Colors.black87),
                          prefixIcon: Icon(Icons.lock, color: Color(0xFFF6CB00)),
                          suffixIcon: GestureDetector(child: Icon(Icons.visibility, color: Color(0xFFF6CB00)), onTap: () {}),
                          contentPadding: EdgeInsets.fromLTRB(20, 10, -20, 10),
                          focusedBorder:
                              OutlineInputBorder(borderRadius: BorderRadius.circular(25), borderSide: BorderSide(width: 2, color: Color(0xFFF6CB00))),
                          enabledBorder:
                              OutlineInputBorder(borderRadius: BorderRadius.circular(25), borderSide: BorderSide(color: Color(0xFFF6CB00))))),
                  SizedBox(height: 30),
                  Material(
                      borderRadius: BorderRadius.circular(25),
                      color: Color(0xFFF6CB00),
                      child: MaterialButton(
                          minWidth: double.infinity,
                          onPressed: () {
                            Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) {
                              return Home();
                            }));
                          },
                          child: Icon(Icons.arrow_forward, color: Colors.white))),
                  SizedBox(height: 15),
                  Row(mainAxisAlignment: MainAxisAlignment.end, children: <Widget>[
                    GestureDetector(
                        onTap: () {
                          Navigator.push(context, MaterialPageRoute(builder: (context) {
                            return ForgotPassword();
                          }));
                        },
                        child: Text('FORGOT PASSWORD?', style: TextStyle(color: Color(0xFFF6CB00)))),
                  ]),
                ]))),
        // begin:: untuk footer
        Footer(),
        // end:: untuk footer
      ])),
    );
  }

  @override
  Widget build(BuildContext context) {
    return _signInScreen();
  }
}
