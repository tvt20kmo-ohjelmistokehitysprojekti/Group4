#ifndef NOSTO_H
#define NOSTO_H

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

private:
    Ui::nosto *ui;
};

#endif // NOSTO_H
