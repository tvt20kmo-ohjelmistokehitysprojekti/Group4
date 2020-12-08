#ifndef KORTTI_H
#define KORTTI_H

#include <QWidget>

namespace Ui {
class kortti;
}

class kortti : public QWidget
{
    Q_OBJECT

public:
    explicit kortti(QWidget *parent = 0);
    ~kortti();

    QString getCardID()const;
    void setCardID(const QString &value);


private slots:
    void on_btnChooseDebit_clicked();

    void on_btnChooseCredit_clicked();

private:
    Ui::kortti *ui;
    QString CardID;


};

#endif // KORTTI_H
