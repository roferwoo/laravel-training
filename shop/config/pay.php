<?php

return [
    'alipay' => [
        'app_id'         => '2016092000554170',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0GbbTh0Qa40eVqjxeLrecCG1iIgisqxP7nJw5baAqQ7Y5LWs6v0kKvv86Bkt1czAprV3fKv+6uo8rxvBJOj+cNmfieBwvqiUGOv2ZA/IraZSmBL+bSIRkn3VMNbYLQ8f+2WenPE0DXANeUCwvGT77+K7+nAhdFPa6Hb9+T7Dn93kjZj1CMTtCzP0/mg3G0HwBZrLoVYhoc0fPSA0FCo7QAIdYsfAhAuuXKUEe4kGXdpR2uJ/eTPMUWaETxRJ/HPS7rAdlrJ5Hns2e9pUBFyulvgTsbSLodlbDhqM9y5yrkusAjUxTW2o6TmpAbIQ8nPgGmqGUUYSDYqckfpj9i5MLwIDAQAB',
        'private_key'    => 'MIIEowIBAAKCAQEA1i13tGncJXd7/iP0OoiQWbXd7T6PFBsTIndfxnU0U28tCQ2Al++HHgyrvDLdqwVeqUv6Iw6nlMxlePe0e5fb0aQ0988u4bed1mJoYCYTRkD7iwTRVVCIQ4699DRSh3mxG0cLrKUay+3ZDL7ETM4KUVz3YCVB0Af3LFJTymH6TGlsCaRXxi8qqXUx6pECzE11lBpGSnw1rEWMYUUHvUWIy9ohpeJUNucxgkyZ2UZDd0HexYuF95WoFYjz/3ZgydVyngogLc5cV9kXmE4T968oj4l+IDS+zuxuQbYdecKsOAfft/L7A5vLi8jpr8q8Hx60yoK8BlKqgLmIfHL35Zks6wIDAQABAoIBABm4MA3MQJGHPa6RJrz4tUzwmAvrXUcu0SdsamXsoTH7wc66flzAeNtU7jKVcSUeafWumAUpt1oZCX5zUIse+1i7fVjc2mZkpGGgQ6R4LgxbtVlGZNT37MUgGROATQDTzj7WU0KSORuQHmZ3ah9HBtoqbdJv5u1SZ448/K7rASG3ts+4YBewd0xAsDBtJq5BkUKzeVAkk6j/mwLqzmqUQkEhXQd6NJwTxKv1e9EmHQ3hGDITcwKxkkLkBSbWvampLW1HMeKtA3LvxTE8CStZGRJLHKw8Ll7mXmKo2R5D/VLTN6ZMMSgBHioEudRyjHWsAe2XEfncSXa7dxrgw9QAhTECgYEA+wkSdS+PEWvJ36e+9hYlw3KID5rdpjdpMUVFYtb4UrhsUnaRr/OdaeV0xaSNwcz3epFOmro7dEn7Z+kIZ61Nqbvz7dMTNBO/aYlWhcrNQHJVz5NzhRy/+2GKTy37TKl6LotFGHWnbOtJ9Z7roHcHbRj6TpZbDaslWKN3GiPeUkcCgYEA2mnLNOI0IvnhTe5VKz4d0qanfKKL5Tc1388bYVNAG41scBvjRxd+D7R0Kyq0RWwn+UbrwdvQDgwD8yzgt7dGK/NOf5Tc6vvY4PcuYqwPf4Wc2Q2rm0/IeqYqQG9k49tNqQ7jYTbmLoNBnAFgJueBqVt+rtrIVooVEgpNKiyK3j0CgYEAjfewd5Ng3qJNtW2BYlxeGO1Bo0maxjCaDeI1/lLCds2TfQNPGum0ATph0pBgFtTatHdOs9RUYUyhoD86oJ9yx2Xi6oGvX4k3e/DOfLWXZDYE73JdJ09+ByU/ec3wS4eg8IeUmOOYvtFFr2Gjscj+6yTwEdeYQN+kLD+t0JuuVGsCgYBilW/4PcXEp78vWs0siIwTgc+FbSTx4Bq8G5JDOr1r8kiozZ2ngA4RbqUkutDFqQzd8koFpX7iaD/8KhyAMARHYDnlUj7o/aYl3MweE4WnTJrASfBUWQ2ndosJrH4AbwM9tI+jWJFLG0mo7eIFjWc0Fy02JWBZ11etXeL4j0RbDQKBgB1Xj2TrNB1ZzGZarrr1mUASHsvL6NolrkYQ6x6o3hRC5r+ZRrGPxJVrssn1LHP8YySD3CtyEmCR0YExQ4hucZMzyehqKODH0gbI7He9ZFqEDcBJRVUvmKWt1wWONEYdqMjB5ZdTjQnq0vlaRM8CnrY91MmEx+cAyDfGUYc5KHML',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];