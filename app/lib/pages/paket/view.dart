import 'package:aaa/pages/paket/detail.dart';
import 'package:flutter/material.dart';

class Paket extends StatelessWidget {
  _listPaket(context) {
    return CustomScrollView(
      slivers: <Widget>[
        SliverList(
          delegate: SliverChildListDelegate([
            Container(
              child: Column(
                children: <Widget>[
                  Container(
                    margin: EdgeInsets.all(10),
                    height: 100,
                    child: Card(
                      clipBehavior: Clip.antiAlias,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      color: Colors.white,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Expanded(
                            child: GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PaketDetail(),
                                  ),
                                );
                              },
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const ListTile(
                                    leading: Icon(
                                      Icons.archive,
                                      color: const Color(0xFFF6CB00),
                                      size: 45,
                                    ),
                                    title: Text(
                                      "Nama Paket",
                                      style: TextStyle(fontSize: 20),
                                    ),
                                    subtitle: Text('26 April 2023'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            color: Colors.amber,
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.all(10),
                    height: 100,
                    child: Card(
                      clipBehavior: Clip.antiAlias,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      color: Colors.white,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Expanded(
                            child: GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PaketDetail(),
                                  ),
                                );
                              },
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const ListTile(
                                    leading: Icon(
                                      Icons.archive,
                                      color: const Color(0xFFF6CB00),
                                      size: 45,
                                    ),
                                    title: Text(
                                      "Nama Paket",
                                      style: TextStyle(fontSize: 20),
                                    ),
                                    subtitle: Text('26 April 2023'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            color: Colors.amber,
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.all(10),
                    height: 100,
                    child: Card(
                      clipBehavior: Clip.antiAlias,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      color: Colors.white,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Expanded(
                            child: GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PaketDetail(),
                                  ),
                                );
                              },
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const ListTile(
                                    leading: Icon(
                                      Icons.archive,
                                      color: const Color(0xFFF6CB00),
                                      size: 45,
                                    ),
                                    title: Text(
                                      "Nama Paket",
                                      style: TextStyle(fontSize: 20),
                                    ),
                                    subtitle: Text('26 April 2023'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            color: Colors.amber,
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.all(10),
                    height: 100,
                    child: Card(
                      clipBehavior: Clip.antiAlias,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      color: Colors.white,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Expanded(
                            child: GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PaketDetail(),
                                  ),
                                );
                              },
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const ListTile(
                                    leading: Icon(
                                      Icons.archive,
                                      color: const Color(0xFFF6CB00),
                                      size: 45,
                                    ),
                                    title: Text(
                                      "Nama Paket",
                                      style: TextStyle(fontSize: 20),
                                    ),
                                    subtitle: Text('26 April 2023'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            color: Colors.amber,
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                  ),
                  Container(
                    margin: EdgeInsets.all(10),
                    height: 100,
                    child: Card(
                      clipBehavior: Clip.antiAlias,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8.0),
                      ),
                      color: Colors.white,
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        children: <Widget>[
                          Expanded(
                            child: GestureDetector(
                              onTap: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PaketDetail(),
                                  ),
                                );
                              },
                              child: Column(
                                mainAxisAlignment: MainAxisAlignment.center,
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  const ListTile(
                                    leading: Icon(
                                      Icons.archive,
                                      color: const Color(0xFFF6CB00),
                                      size: 45,
                                    ),
                                    title: Text(
                                      "Nama Paket",
                                      style: TextStyle(fontSize: 20),
                                    ),
                                    subtitle: Text('26 April 2023'),
                                  ),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            color: Colors.amber,
                            width: 10,
                          ),
                        ],
                      ),
                    ),
                  ),
                ],
              ),
            )
          ]),
        ),
      ],
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
        child: _listPaket(context),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return _paketScreen(context);
  }
}
