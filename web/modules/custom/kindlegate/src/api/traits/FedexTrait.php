<?php

namespace  Drupal\kindlegate\api\traits;

trait FedexTrait
{
    function serializeOrderData($data)
    {
        $data = $data;
    }

    function serializeRateData(array $datas)
    {
        $data = [
            "accountNumber" => [
                "value" => "XXX61073"
            ],
            "rateRequestControlParameters" => [
                "returnTransitTimes" => false,
                "servicesNeededOnRateFailure" => true,
                "variableOptions" => "FREIGHT_GUARANTEE",
                "rateSortOrder" => "SERVICENAMETRADITIONAL"
            ],
            "freightRequestedShipment" => [
                "shipper" => [
                    "address" => [
                        "streetLines" => [
                            "1550 Union Blvd",
                            "Suite 302"
                        ],
                        "city" => "Beverly Hills",
                        "stateOrProvinceCode" => "TN",
                        "postalCode" => "65247",
                        "countryCode" => "US",
                        "residential" => false
                    ]
                ],
                "recipient" => [
                    "address" => [
                        "streetLines" => [
                            "1550 Union Blvd",
                            "Suite 302"
                        ],
                        "city" => "Beverly Hills",
                        "stateOrProvinceCode" => "TN",
                        "postalCode" => "65247",
                        "countryCode" => "US",
                        "residential" => false
                    ]
                ],
                "serviceType" => "FEDEX_FREIGHT_PRIORITY",
                "preferredCurrency" => "USD",
                "shippingChargesPayment" => [
                    "payor" => [
                        "responsibleParty" => [
                            "address" => [
                                "streetLines" => [
                                    "10 FedEx Parkway",
                                    "Suite 302"
                                ],
                                "city" => "Beverly Hills",
                                "stateOrProvinceCode" => "CA",
                                "postalCode" => "90210",
                                "countryCode" => "US",
                                "residential" => false
                            ],
                            "contact" => [
                                "personName" => "John Taylor",
                                "emailAddress" => "sample@company.com",
                                "phoneNumber" => "1234567890",
                                "phoneExtension" => "phone extension",
                                "companyName" => "Fedex",
                                "faxNumber" => "fax number"
                            ],
                            "accountNumber" => [
                                "value" => "123456789"
                            ]
                        ]
                    ],
                    "paymentType" => "SENDER"
                ],
                "rateRequestType" => [
                    "LIST"
                ],
                "shipDateStamp" => "2019-09-06",
                "requestedPackageLineItems" => [
                    [
                        "subPackagingType" => "BAG",
                        "groupPackageCount" => 1,
                        "contentRecord" => [
                            [
                                "itemNumber" => "string",
                                "receivedQuantity" => 0,
                                "description" => "string",
                                "partNumber" => "string"
                            ]
                        ],
                        "declaredValue" => [
                            "amount" => "100",
                            "currency" => "USD"
                        ],
                        "weight" => [
                            "units" => "LB",
                            "value" => 22
                        ],
                        "dimensions" => [
                            "length" => 10,
                            "width" => 8,
                            "height" => 2,
                            "units" => "IN"
                        ],
                        "associatedFreightLineItems" => [
                            [
                                "id" => "string"
                            ]
                        ]
                    ]
                ],
                "totalPackageCount" => 3,
                "totalWeight" => 87,
                "freightShipmentDetail" => [
                    "role" => "CONSIGNEE",
                    "accountNumber" => [
                        "value" => "XXXXX6789"
                    ],
                    "declaredValueUnits" => "string",
                    "shipmentDimensions" => [
                        "length" => 10,
                        "width" => 8,
                        "height" => 2,
                        "units" => "IN"
                    ],
                    "lineItem" => [
                        [
                            "handlingUnits" => 0,
                            "nmfcCode" => "string",
                            "subPackagingType" => "BAG",
                            "description" => "string",
                            "weight" => [
                                "units" => "LB",
                                "value" => 22
                            ],
                            "pieces" => 0,
                            "volume" => [
                                "units" => "CUBIC_FT",
                                "value" => 0
                            ],
                            "freightClass" => "CLASS_050",
                            "purchaseOrderNumber" => "string",
                            "id" => "string",
                            "hazardousMaterials" => "HAZARDOUS_MATERIALS",
                            "dimensions" => [
                                "length" => 10,
                                "width" => 8,
                                "height" => 2,
                                "units" => "IN"
                            ]
                        ]
                    ],
                    "clientDiscountPercent" => 0,
                    "fedExFreightBillingContactAndAddress" => [
                        "address" => [
                            "streetLines" => [
                                "string",
                                "Suite 302"
                            ],
                            "city" => "Beverly Hills",
                            "stateOrProvinceCode" => "string",
                            "postalCode" => "string",
                            "countryCode" => "US",
                            "residential" => false
                        ],
                        "contact" => [
                            "personName" => "person name",
                            "emailAddress" => "email address",
                            "phoneNumber" => "phone number",
                            "phoneExtension" => "phone extension",
                            "companyName" => "company name",
                            "faxNumber" => "fax number"
                        ]
                    ],
                    "aliasID" => "string",
                    "hazardousMaterialsOfferor" => "string",
                    "declaredValuePerUnit" => [
                        "amount" => "100",
                        "currency" => "USD"
                    ],
                    "totalHandlingUnits" => 0,
                    "alternateBillingParty" => [
                        "address" => [
                            "streetLines" => [
                                "1550 Union Blvd",
                                "Suite 302"
                            ],
                            "city" => "Beverly Hills",
                            "stateOrProvinceCode" => "TN",
                            "postalCode" => "65247",
                            "countryCode" => "US",
                            "residential" => false
                        ],
                        "accountNumber" => [
                            "value" => "XXX61073"
                        ]
                    ]
                ],
                "freightShipmentSpecialServices" => [
                    "freightGuaranteeDetail" => [
                        "freightGuaranteeType" => "GUARANTEED_DATE",
                        "guaranteeTimestamp" => "string"
                    ],
                    "specialServiceTypes" => [
                        "FREIGHT_GUARANTEE"
                    ],
                    "freightDirectDetail" => [
                        "freightDirectDataDetails" => [
                            [
                                "type" => "STANDARD",
                                "transportationType" => "DELIVERY",
                                "emailAddress" => "abc@def.com",
                                "phoneNumberDetails" => [
                                    [
                                        "phoneNumberType" => "MOBILE",
                                        "phoneNumber" => "XXXXXXXXX12"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return json_encode($data);
    }
}
