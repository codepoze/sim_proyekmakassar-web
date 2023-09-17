import 'package:aaa/auth/sign_in/view.dart';
import 'package:animated_splash_screen/animated_splash_screen.dart';
import 'package:flutter/material.dart';

class Splash extends StatelessWidget {
  _splashIcon() {
    return Center(
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: <Widget>[
          Image.asset(
            'assets/images/logo/logo.png',
            height: 61,
            width: 61,
          ),
          Container(
            child: const Text(
              'MANPRO',
              style: TextStyle(
                fontSize: 18,
                color: Color(0xFFF6CB00),
              ),
            ),
          )
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return AnimatedSplashScreen(
      splash: _splashIcon(),
      duration: 3000,
      splashTransition: SplashTransition.fadeTransition,
      backgroundColor: Colors.white,
      nextScreen: SignIn(),
    );
  }
}
