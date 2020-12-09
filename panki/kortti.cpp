#include "kortti.h"
#include "menu.h"
#include "ui_kortti.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>
#include <QDebug>

kortti::kortti(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::kortti)
{
    ui->setupUi(this);
}

kortti::~kortti()
{
    delete ui;
}

void kortti::on_btnChooseDebit_clicked()
{

    QString card_id=getCardID();

    QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Tili/?idCard="+card_id+"&Type=debit"));
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
        QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
        QJsonObject jsobj = json_doc.object();
        QJsonArray jsarr = json_doc.array();
        QString idAccount;
         foreach (const QJsonValue &value, jsarr){
              QJsonObject jsob = value.toObject();
              idAccount+=jsob["idAccount"].toString();
              qDebug()<<idAccount;
                }

        reply->deleteLater();


        menu *me=new menu();
        me->setAccID(idAccount);
        me->show();
        this->close();


}

void kortti::on_btnChooseCredit_clicked()
{

    QString card_id=getCardID();

    QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Tili/?idCard="+card_id+"&Type=credit"));
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
        QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
        QJsonObject jsobj = json_doc.object();
        QJsonArray jsarr = json_doc.array();
        QString idAccount;
         foreach (const QJsonValue &value, jsarr){
              QJsonObject jsob = value.toObject();
              idAccount+=jsob["idAccount"].toString();
              qDebug()<<idAccount;
                }

        reply->deleteLater();


        menu *me=new menu();
        me->setAccID(idAccount);
        me->show();
        this->close();

}


QString kortti::getCardID() const
{
    return CardID;
}

void kortti::setCardID(const QString &value)
{
    CardID = value;
}
