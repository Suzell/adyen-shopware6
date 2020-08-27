<?php declare(strict_types=1);
/**
 *                       ######
 *                       ######
 * ############    ####( ######  #####. ######  ############   ############
 * #############  #####( ######  #####. ######  #############  #############
 *        ######  #####( ######  #####. ######  #####  ######  #####  ######
 * ###### ######  #####( ######  #####. ######  #####  #####   #####  ######
 * ###### ######  #####( ######  #####. ######  #####          #####  ######
 * #############  #############  #############  #############  #####  ######
 *  ############   ############  #############   ############  #####  ######
 *                                      ######
 *                               #############
 *                               ############
 *
 * Adyen Payment Module
 *
 * Copyright (c) 2020 Adyen B.V.
 * This file is open source and available under the MIT license.
 * See the LICENSE file for more info.
 *
 * Author: Adyen <shopware@adyen.com>
 */

namespace Adyen\Shopware\Service;

use Adyen\Environment;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class ConfigurationService
{
    const BUNDLE_NAME = 'AdyenPaymentShopware6';

    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    /**
     * ConfigurationService constructor.
     *
     * @param SystemConfigService $systemConfigService
     */
    public function __construct(
        SystemConfigService $systemConfigService
    ) {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getMerchantAccount(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.merchantAccount',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getApiKeyTest(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.apiKeyTest',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getApiKeyLive(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.apiKeyLive',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return string
     */
    public function getEnvironment(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.environment',
            $salesChannelId
        ) ? Environment::LIVE : Environment::TEST;
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getLiveEndpointUrlPrefix(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.liveEndpointUrlPrefix',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getNotificationUsername(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.notificationUsername',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getNotificationPassword(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.notificationPassword',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getHmacTest(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.hmacTest',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getHmacLive(string $salesChannelId = null)
    {
        return $this->systemConfigService->get(
            self::BUNDLE_NAME . '.config.hmacLive',
            $salesChannelId
        );
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getHmacKey(string $salesChannelId = null)
    {
        if ($this->getEnvironment($salesChannelId) === Environment::LIVE) {
            return $this->getHmacLive($salesChannelId);
        }

        return $this->getHmacTest($salesChannelId);
    }

    /**
     * @param string|null $salesChannelId
     * @return array|mixed|null
     */
    public function getApiKey(string $salesChannelId = null)
    {
        if ($this->getEnvironment($salesChannelId) === Environment::LIVE) {
            return $this->getApiKeyLive($salesChannelId);
        }

        return $this->getApiKeyTest($salesChannelId);
    }
}
