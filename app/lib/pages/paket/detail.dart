import 'package:aaa/pages/mc0/view.dart';
import 'package:aaa/pages/opname/view.dart';
import 'package:aaa/pages/pengawas/view.dart';
import 'package:aaa/pages/ph0/view.dart';
import 'package:flutter/material.dart';

class PaketDetail extends StatelessWidget {
  _buttonAction(context, show, icon, name) {
    return Card(
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(15),
      ),
      child: InkWell(
        splashColor: Colors.yellow.withAlpha(30),
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => show,
            ),
          );
        },
        child: Container(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            crossAxisAlignment: CrossAxisAlignment.center,
            children: <Widget>[
              SizedBox(
                child: Icon(
                  icon,
                  color: const Color(0xFFF6CB00),
                  size: 70,
                ),
              ),
              Text(name)
            ],
          ),
        ),
      ),
    );
  }

  _paketScreen(context) {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text('PAKET'),
        backgroundColor: const Color(0xFFF6CB00),
      ),
      body: Container(
        margin: const EdgeInsets.all(15),
        child: GridView.count(crossAxisCount: 2, children: <Widget>[
          _buttonAction(context, Mc0(), Icons.add_road, 'MC0'),
          _buttonAction(context, Pengawas(), Icons.add_task, 'PENGAWAS'),
          _buttonAction(context, Ph0(), Icons.add_location_alt_outlined, 'PH0'),
          _buttonAction(context, Opname(), Icons.add_photo_alternate, 'OPNAME'),
        ]),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return _paketScreen(context);
  }
}
