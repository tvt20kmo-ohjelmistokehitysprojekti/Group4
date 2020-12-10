#include "mysingleton.h"

MySingleton* MySingleton::instance = nullptr;

MySingleton* MySingleton::getInstance()
{
    if (instance == nullptr)
    {
        instance = new MySingleton();
    }

    return instance;
}
QString MySingleton::getCardID() const
{
    return CardID;
}

void MySingleton::setCardID(const QString &value)
{
    CardID = value;
}

QString MySingleton::getAccID() const
{
    return AccID;
}

void MySingleton::setAccID(const QString &value)
{
    AccID = value;
}
