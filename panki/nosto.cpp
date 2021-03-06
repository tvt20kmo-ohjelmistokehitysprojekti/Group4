#include "nosto.h"
#include "ui_nosto.h"
#include "kortti.h"
#include "mysingleton.h"
#include "menu.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>
#include <QDebug>


nosto::nosto(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::nosto)
{
    ui->setupUi(this);
}

nosto::~nosto()
{
    delete ui;
}

void nosto::on_btn20_clicked()
{
     QString idAccount, idCard, Amount;
     MySingleton *myS=MySingleton::getInstance();
     idAccount= myS->getAccID();
     idCard= myS->getCardID();
     Amount="20";

        QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Nosto"));
            request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
            //Authenticate
            QString username="admin";
            QString password="1234";
            QString concatenatedCredentials = username + ":" + password;
               QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
               QString headerData = "Basic " + data;
               request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

            QJsonObject json;
            json.insert("idAccount",idAccount);
            json.insert("idCard",idCard);
            json.insert("Amount",Amount);
            QNetworkAccessManager nam;
            QNetworkReply *reply = nam.post(request, QJsonDocument(json).toJson());
            while (!reply->isFinished())
            {
                qApp->processEvents();
            }
            QByteArray response_data = reply->readAll();
            qDebug()<<response_data;
            //ui->labelInfo->setText("Added : "+response_data);
            reply->deleteLater();

}

void nosto::on_btn40_clicked()
{
    QString idAccount, idCard, Amount;
    MySingleton *myS=MySingleton::getInstance();
    idAccount= myS->getAccID();
    idCard= myS->getCardID();
    Amount="40";

        QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Nosto/"));
            request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
            //Authenticate
            QString username="admin";
            QString password="1234";
            QString concatenatedCredentials = username + ":" + password;
               QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
               QString headerData = "Basic " + data;
               request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

            QJsonObject json;
            json.insert("idAccount",idAccount);
            json.insert("idCard",idCard);
            json.insert("Amount",Amount);
            QNetworkAccessManager nam;
            QNetworkReply *reply = nam.post(request, QJsonDocument(json).toJson());
            while (!reply->isFinished())
            {
                qApp->processEvents();
            }
            QByteArray response_data = reply->readAll();
            qDebug()<<response_data;
            //ui->labelInfo->setText("Added : "+response_data);
            reply->deleteLater();
}

void nosto::on_btn50_clicked()
{
    QString idAccount, idCard, Amount;
    MySingleton *myS=MySingleton::getInstance();
    idAccount= myS->getAccID();
    idCard= myS->getCardID();
    Amount="50";

        QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Nosto/"));
            request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
            //Authenticate
            QString username="admin";
            QString password="1234";
            QString concatenatedCredentials = username + ":" + password;
               QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
               QString headerData = "Basic " + data;
               request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

            QJsonObject json;
            json.insert("idAccount",idAccount);
            json.insert("idCard",idCard);
            json.insert("Amount",Amount);
            QNetworkAccessManager nam;
            QNetworkReply *reply = nam.post(request, QJsonDocument(json).toJson());
            while (!reply->isFinished())
            {
                qApp->processEvents();
            }
            QByteArray response_data = reply->readAll();
            qDebug()<<response_data;
            //ui->labelInfo->setText("Added : "+response_data);
            reply->deleteLater();
}

void nosto::on_btn100_clicked()
{
    QString idAccount, idCard, Amount;
    MySingleton *myS=MySingleton::getInstance();
    idAccount= myS->getAccID();
    idCard= myS->getCardID();
    Amount="100";

        QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Nosto/"));
            request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
            //Authenticate
            QString username="admin";
            QString password="1234";
            QString concatenatedCredentials = username + ":" + password;
               QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
               QString headerData = "Basic " + data;
               request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

            QJsonObject json;
            json.insert("idAccount",idAccount);
            json.insert("idCard",idCard);
            json.insert("Amount",Amount);
            QNetworkAccessManager nam;
            QNetworkReply *reply = nam.post(request, QJsonDocument(json).toJson());
            while (!reply->isFinished())
            {
                qApp->processEvents();
            }
            QByteArray response_data = reply->readAll();
            qDebug()<<response_data;
            //ui->labelInfo->setText("Added : "+response_data);
            reply->deleteLater();
}

void nosto::on_btnOKSumma_clicked()
{
    QString idAccount, idCard, Amount;
    MySingleton *myS=MySingleton::getInstance();
    idAccount= myS->getAccID();
    idCard= myS->getCardID();
    Amount=ui->lineEditSumma->text();

        QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Nosto/"));
            request.setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
            //Authenticate
            QString username="admin";
            QString password="1234";
            QString concatenatedCredentials = username + ":" + password;
               QByteArray data = concatenatedCredentials.toLocal8Bit().toBase64();
               QString headerData = "Basic " + data;
               request.setRawHeader( "Authorization", headerData.toLocal8Bit() );

            QJsonObject json;
            json.insert("idAccount",idAccount);
            json.insert("idCard",idCard);
            json.insert("Amount",Amount);
            QNetworkAccessManager nam;
            QNetworkReply *reply = nam.post(request, QJsonDocument(json).toJson());
            while (!reply->isFinished())
            {
                qApp->processEvents();
            }
            QByteArray response_data = reply->readAll();
            qDebug()<<response_data;
            //ui->labelInfo->setText("Added : "+response_data);
            reply->deleteLater();
}



void nosto::on_btnExit_clicked()
{
    this->close();
}
