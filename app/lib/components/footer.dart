import 'package:flutter/material.dart';

class Footer extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Container(
        padding: EdgeInsets.all(15),
        child: Wrap(children: <Widget>[
          Container(alignment: Alignment.center, child: Text('Dinas Pekerja Umum Kota Makassar', style: TextStyle(color: Colors.black))),
          Container(alignment: Alignment.center, child: Text('@ Copyright 2020', style: TextStyle(color: Colors.black, fontSize: 10)))
        ]));
  }
}
