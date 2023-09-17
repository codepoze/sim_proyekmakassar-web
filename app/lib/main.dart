import 'package:aaa/pages/home/home.dart';
import 'package:aaa/pages/sign_in/sign_in.dart';
import 'package:aaa/components/splash.dart';
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
        '/': (context) => const Splash(),
        '/home': (context) => Home(),
        '/sign_in': (context) => SignIn(),
      },
    );
  }
}
