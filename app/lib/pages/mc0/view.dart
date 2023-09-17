import 'package:flutter/material.dart';

class Mc0 extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();

  _form() {
    return CustomScrollView(
      slivers: <Widget>[
        SliverList(
          delegate: SliverChildListDelegate([
            Form(
              key: _formKey,
              autovalidateMode: AutovalidateMode.onUserInteraction,
              child: Column(
                children: <Widget>[
                  TextFormField(
                    decoration: const InputDecoration(
                      labelText: 'CC0 *',
                      hintText: 'Masukkan CC0',
                    ),
                  ),
                  TextFormField(
                    decoration: const InputDecoration(
                      labelText: 'Volume MC0 *',
                      hintText: 'Masukkan Volume MC0',
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.only(right: 10, top: 10, bottom: 10),
                    child: ElevatedButton(
                      style: ButtonStyle(
                        backgroundColor: MaterialStateProperty.all<Color>(Colors.blue),
                      ),
                      onPressed: () => {},
                      child: Container(
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: const <Widget>[Text("Upload Foto", style: TextStyle(color: Colors.white))],
                        ),
                      ),
                    ),
                  ),
                  Container(
                    padding: const EdgeInsets.only(right: 10, top: 10, bottom: 10),
                    child: ElevatedButton(
                      style: ButtonStyle(
                        backgroundColor: MaterialStateProperty.all<Color>(Colors.blue),
                      ),
                      onPressed: () => {},
                      child: Container(
                        child: Row(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: const <Widget>[Text("Upload Dokumen", style: TextStyle(color: Colors.white))],
                        ),
                      ),
                    ),
                  ),
                ],
              ),
            ),
          ]),
        ),
      ],
    );
  }

  _loading() {
    return const Center(
      child: CircularProgressIndicator(),
    );
  }

  _mc0Screen() {
    return Scaffold(
      appBar: AppBar(
        centerTitle: true,
        title: Text('MC0'),
        backgroundColor: const Color(0xFFF6CB00),
        actions: <Widget>[
          Padding(
            padding: const EdgeInsets.only(right: 20.0),
            child: GestureDetector(
              child: const Icon(
                Icons.check,
                size: 26.0,
              ),
            ),
          ),
        ],
      ),
      body: Container(
        margin: const EdgeInsets.only(left: 20, right: 20, top: 20, bottom: 20),
        child: _form(),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return _mc0Screen();
  }
}
