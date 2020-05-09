<?php
exit;

/**
 * @OA\Info(
 *     description="Hotel PMS API Endpoints",
 *     version="1.0.0",
 *     title="Hotel-PMS API",
 * )
 */

//TAGS
/**
 * @OA\Tag(
 *   name="Auth",
 *   description="Auth API"
 * )
 */
/**
 * @OA\Tag(
 *   name="Hotels",
 *   description="Hotels API"
 * )
 */
/**
 * @OA\SecurityScheme(
 *   securityScheme="api_token",
 *   type="apiKey",
 *   in="header",
 *   name="Authorization"
 * ),
 * @OA\SecurityScheme(
 *   securityScheme="x-api-key",
 *   type="apiKey",
 *   in="header",
 *   name="x-api-key"
 * )
 */
