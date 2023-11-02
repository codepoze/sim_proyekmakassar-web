import 'package:manpro/screens/mc0/view.dart';
import 'package:manpro/screens/opname/view.dart';
import 'package:manpro/screens/pengawas/view.dart';
import 'package:manpro/screens/ph0/view.dart';
import 'package:flutter/material.dart';

class PaketDetail extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    _buttonAction(show, icon, name) {
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

    _paketScreen() {
      return Scaffold(
        appBar: AppBar(
          centerTitle: true,
          title: Text('PAKET'),
          backgroundColor: const Color(0xFFF6CB00),
        ),
        body: Container(
          margin: const EdgeInsets.all(15),
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Container(
                child: GridView.count(
                  shrinkWrap: true,
                  crossAxisCount: 2,
                  children: [
                    _buttonAction(Mc0(), Icons.add_road, 'MC0'),
                    _buttonAction(Pengawas(), Icons.add_task, 'PENGAWAS'),
                    _buttonAction(Ph0(), Icons.add_location_alt_outlined, 'PH0'),
                    _buttonAction(Opname(), Icons.add_photo_alternate, 'OPNAME'),
                  ],
                ),
              ),
            ],
          ),
        ),
      );
    }

    return _paketScreen();
  }
}
