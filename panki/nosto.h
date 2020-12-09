#ifndef NOSTO_H
#define NOSTO_H
#include <kortti.h>
#include <menu.h>

#include <QWidget>

namespace Ui {
class nosto;
}

class nosto : public QWidget
{
    Q_OBJECT

public:
    explicit nosto(QWidget *parent = 0);
    ~nosto();

private slots:
    void on_btn20_clicked();

    void on_btn40_clicked();

    void on_btn50_clicked();

    void on_btn100_clicked();

    void on_btnOKSumma_clicked();

private:
    Ui::nosto *ui;
};

#endif // NOSTO_H
