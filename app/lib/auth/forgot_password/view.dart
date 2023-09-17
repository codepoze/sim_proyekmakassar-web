import 'package:aaa/auth/sign_in/view.dart';
import 'package:aaa/components/footer.dart';
import 'package:flutter/material.dart';

class ForgotPassword extends StatefulWidget {
  @override
  State<ForgotPassword> createState() => _ForgotPasswordState();
}

class _ForgotPasswordState extends State<ForgotPassword> {
  _forgotPasswordScreen() {
    return Scaffold(
      body: Center(
          child: ListView(shrinkWrap: true, children: <Widget>[
        Container(margin: EdgeInsets.only(top: 30), alignment: Alignment.center, child: Image.asset("assets/images/logo.png", width: 100)),
        Card(
            margin: EdgeInsets.all(30),
            elevation: 3,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(25)),
            child: Padding(
                padding: EdgeInsets.all(40),
                child: Column(children: <Widget>[
                  Container(
                      padding: EdgeInsets.only(bottom: 30),
                      child: Text("FORGOT PASSWORD", style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold, color: Color(0xFFF6CB00)))),
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
                  SizedBox(height: 30),
                  Wrap(children: <Widget>[
                    Container(
                      padding: const EdgeInsets.fromLTRB(0, 10, 0, 10),
                      child: Material(
                          borderRadius: BorderRadius.circular(25),
                          color: Color(0xFFF6CB00),
                          child: MaterialButton(minWidth: double.infinity, onPressed: () {}, child: Icon(Icons.arrow_forward, color: Colors.white))),
                    ),
                    Container(
                      padding: const EdgeInsets.fromLTRB(0, 10, 0, 10),
                      child: Material(
                          borderRadius: BorderRadius.circular(25),
                          color: Color(0xFFF6CB00),
                          child: MaterialButton(
                              minWidth: double.infinity,
                              onPressed: () {
                                Navigator.pop(context, MaterialPageRoute(builder: (context) {
                                  return SignIn();
                                }));
                              },
                              child: Icon(Icons.arrow_back, color: Colors.white))),
                    )
                  ])
                ]))),
        // begin:: untuk footer
        Footer(),
        // end:: untuk footer
      ])),
    );
  }

  @override
  Widget build(BuildContext context) {
    return _forgotPasswordScreen();
  }
}
