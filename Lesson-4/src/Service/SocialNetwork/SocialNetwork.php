<?php


namespace Service\SocialNetwork;


interface SocialNetwork
{
    // Сделал как пример авторизацию OAuth 2.0

    /**
     * Получение ссылки для авторизации
     * @return string
     */
    public function loginLink(): string;

    /**
     * Сохранение токена и обработка ошибок
     * @return mixed
     */
    public function callBackLogin();

}