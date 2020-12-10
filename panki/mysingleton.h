#ifndef MYSINGLETON_H
#define MYSINGLETON_H
#include <qstring.h>

class MySingleton
{
private:
    static MySingleton* instance;
    QString AccID;
    QString CardID;

public:
    static MySingleton* getInstance();


    QString getAccID() const;
    void setAccID(const QString &value);
    QString getCardID() const;
    void setCardID(const QString &value);
};

#endif // MYSINGLETON_H
