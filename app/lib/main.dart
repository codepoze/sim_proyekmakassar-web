import 'package:aaa/auth/sign_in/view.dart';
import 'package:aaa/pages/home.dart';
import 'package:aaa/pages/paket/detail.dart';
import 'package:aaa/pages/paket/view.dart';
import 'package:aaa/widgets/splash.dart';
import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'SAFETY',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primaryColor: const Color(0xFFFFFFFF),
      ),
      initialRoute: '/',
      routes: {
        '/': (context) => Splash(),
        '/home': (context) => Home(),
        '/sign_in': (context) => SignIn(),
      },
    );
  }
}
