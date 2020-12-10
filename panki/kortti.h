#ifndef KORTTI_H
#define KORTTI_H
#include <menu.h>
#include <nosto.h>
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


private slots:
    void on_btnChooseDebit_clicked();

    void on_btnChooseCredit_clicked();

private:
    Ui::kortti *ui;



};

#endif // KORTTI_H
