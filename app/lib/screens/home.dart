import 'package:manpro/screens/paket/view.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';

class Home extends StatefulWidget {
  @override
  State<Home> createState() => _HomeState();
}

class _HomeState extends State<Home> {
  List<String> imgList = [
    'assets/images/slider/slide1.jpg',
    'assets/images/slider/slide2.jpg',
    'assets/images/slider/slide3.jpg',
  ];

  @override
  Widget build(BuildContext context) {
    _homeScreen() {
      return Scaffold(
        appBar: AppBar(
          title: const Center(
            child: Text('MANPRO'),
          ),
          backgroundColor: const Color(0xFFF6CB00),
        ),
        body: Center(
          child: Column(
            children: <Widget>[
              CarouselSlider(
                options: CarouselOptions(
                  enlargeCenterPage: true,
                  aspectRatio: 2.0,
                  autoPlay: true,
                ),
                items: imgList
                    .map(
                      (item) => Image.asset(item, fit: BoxFit.cover, width: 1000),
                    )
                    .toList(),
              ),
              Container(
                margin: const EdgeInsets.only(top: 20),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: <Widget>[
                    Card(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(15),
                        //set border radius more than 50% of height and width to make circle
                      ),
                      child: InkWell(
                        splashColor: Colors.yellow.withAlpha(30),
                        onTap: () {},
                        child: const SizedBox(
                          width: 150,
                          height: 100,
                          child: Icon(
                            Icons.info,
                            color: const Color(0xFFF6CB00),
                            size: 70,
                          ),
                        ),
                      ),
                    ),
                    Card(
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(15),
                        //set border radius more than 50% of height and width to make circle
                      ),
                      child: InkWell(
                        splashColor: Colors.yellow.withAlpha(30),
                        onTap: () {
                          Navigator.push(
                            context,
                            MaterialPageRoute(
                              builder: (context) => Paket(),
                            ),
                          );
                        },
                        child: const SizedBox(
                          width: 150,
                          height: 100,
                          child: Icon(
                            Icons.add,
                            color: const Color(0xFFF6CB00),
                            size: 70,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ],
          ),
        ),
      );
    }

    return _homeScreen();
  }
}
