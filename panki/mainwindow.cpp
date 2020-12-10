#include "kortti.h"
#include "mysingleton.h"
#include "mainwindow.h"
#include "ui_mainwindow.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>

MainWindow::MainWindow(QWidget *parent)
    : QMainWindow(parent)
    , ui(new Ui::MainWindow)
{
    ui->setupUi(this);
}

MainWindow::~MainWindow()
{
    delete ui;
}


void MainWindow::on_btnLogin_clicked()
{
    QString card_id,card_pin;
    card_id=ui->lineEditUsername->text();
    card_pin=ui->lineEditPassword->text();

    QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Login/index_get/?idCard="+card_id+"&Pin="+card_pin));
        request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
        //Authenticate
        QString username="admin";
        QString password="1234";
        QString concatenatedCredentials = username + ":" + password;
           QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
           QString headerData = "Basic " + data;
           request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

        QNetworkAccessManager nam;
        QNetworkReply *reply = nam.get(request);
        while (!reply->isFinished())
        {
            qApp->processEvents();
        }
        QByteArray response_data = reply->readAll();

        qDebug()<<"DATA:"+response_data;

        reply->deleteLater();

        if(response_data==("true")){
            ui->labelLoginTest->setText("Right");
            MySingleton *myS= MySingleton::getInstance();
            myS->setCardID(card_id);
            kortti *ko=new kortti();
            ko->show();
            this->close();
        }
        else {
            ui->labelLoginTest->setText("Väärä PIN tai käyttäjä");
        }
}
