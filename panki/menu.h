#ifndef MENU_H
#define MENU_H
#include <kortti.h>

#include <QWidget>

namespace Ui {
class menu;
}

class menu : public QWidget
{
    Q_OBJECT

public:
    explicit menu(QWidget *parent = 0);
    ~menu();

    QString getAccID() const;
    void setAccID(const QString &value);

private slots:
    void on_btnChooseWithdraw_clicked();

    void on_btnChooseSaldo_clicked();

    void on_btnChooseTransactions_clicked();

    void on_btnExit_clicked();

private:
    Ui::menu *ui;
    QString AccID;
};

#endif // MENU_H
