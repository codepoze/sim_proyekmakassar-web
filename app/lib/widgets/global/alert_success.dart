import 'package:manpro/screens/home.dart';
import 'package:flutter/material.dart';

class AlertSuccess extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    _alertSuccess() {
      return Scaffold(
        body: Center(
          child: Container(
            width: 322,
            height: 445,
            child: Card(
              elevation: 3,
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(25),
              ),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Container(
                    width: 117,
                    height: 117,
                    decoration: new BoxDecoration(
                      color: Color(0xFF87B87F),
                      shape: BoxShape.circle,
                    ),
                    child: Icon(
                      Icons.check,
                      color: Colors.white,
                      size: 100,
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10, bottom: 10),
                    child: Text(
                      "Gagal!",
                      style: TextStyle(fontSize: 25, fontWeight: FontWeight.bold),
                    ),
                  ),
                  Container(
                    padding: EdgeInsets.only(top: 10, bottom: 10),
                    child: Text(
                      "Maaf, Anda tidak dapat melakukan Booking Service.",
                      style: TextStyle(fontSize: 12, fontWeight: FontWeight.bold),
                    ),
                  ),
                  Container(
                    child: MaterialButton(
                      onPressed: () {
                        Navigator.of(context).pushAndRemoveUntil(
                          MaterialPageRoute(
                            builder: (BuildContext context) => Home(),
                          ),
                          (Route route) => false,
                        );
                      },
                      color: Color(0xFF87B87F),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.all(
                          Radius.circular(20),
                        ),
                      ),
                      child: Container(
                        width: 250,
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: <Widget>[
                            Icon(
                              Icons.arrow_forward,
                              color: Colors.white,
                            ),
                            Text(
                              "Selesai",
                              style: TextStyle(color: Colors.white),
                            )
                          ],
                        ),
                      ),
                    ),
                  )
                ],
              ),
            ),
          ),
        ),
      );
    }

    return _alertSuccess();
  }
}
