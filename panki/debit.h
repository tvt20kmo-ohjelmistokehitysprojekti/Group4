#ifndef DEBIT_H
#define DEBIT_H

#include <QWidget>

namespace Ui {
class debit;
}

class debit : public QWidget
{
    Q_OBJECT

public:
    explicit debit(QWidget *parent = 0);
    ~debit();

private:
    Ui::debit *ui;
};

#endif // DEBIT_H
