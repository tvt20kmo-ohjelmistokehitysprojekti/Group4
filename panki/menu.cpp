#include "menu.h"
#include "ui_menu.h"
#include "kortti.h"
#include "nosto.h"
#include <QtNetwork>
#include <QNetworkAccessManager>
#include <QJsonDocument>
#include <qjsondocument.h>
#include <QDebug>


menu::menu(QWidget *parent) :
    QWidget(parent),
    ui(new Ui::menu)
{
    ui->setupUi(this);
}

menu::~menu()
{
    delete ui;
}


void menu::on_btnChooseWithdraw_clicked()
{
    nosto *no=new nosto();
    no->show();
    this->close();

}

void menu::on_btnChooseSaldo_clicked()
{
            QString idAccount=getAccID();

            QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Saldo/?idAccount="+idAccount));
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

               QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
               //QJsonObject jsobj = json_doc.object();  // useless line? wtf...
               QJsonArray jsarr = json_doc.array();

               QString account;
               foreach (const QJsonValue &value, jsarr) {
                 QJsonObject jsob = value.toObject();
                 account+=jsob["Saldo"].toString()+" €"+"\r";
                 ui->labelSaldo->setText(account);
               }

               reply->deleteLater();
       }

QString menu::getAccID() const
{
    return AccID;
}

void menu::setAccID(const QString &value)
{
    AccID = value;
}

void menu::on_btnChooseTransactions_clicked()
{
    QString idAccount=getAccID();

    QNetworkRequest request(QUrl("http://www.students.oamk.fi/~t9momi01/Group4/index.php/api/Pankki/Tapahtumat/?idAccount="+idAccount));
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

       QJsonDocument json_doc = QJsonDocument::fromJson(response_data);
       //QJsonObject jsobj = json_doc.object();  // useless line? wtf...
       QJsonArray jsarr = json_doc.array();

       QString trans;
       foreach (const QJsonValue &value, jsarr) {
       QJsonObject jsob = value.toObject();
       trans+=jsob["Amount"].toString()+" €, "+jsob["Date"].toString()+"\r";
       ui->texTapahtumat->setText(trans);

       }


       reply->deleteLater();
}

void menu::on_btnExit_clicked()
{
    this->close();
}

