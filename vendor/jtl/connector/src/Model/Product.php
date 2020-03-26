<?php
/**
 * @copyright 2010-2015 JTL-Software GmbH
 */

namespace jtl\Connector\Model;

use DateTime;
use InvalidArgumentException;
use JMS\Serializer\Annotation as Serializer;

/**
 * Product properties.
 *
 *
 * @Serializer\AccessType("public_method")
 */
class Product extends DataModel {
    /**
     * @var Identity Optional reference to basePriceUnit
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("basePriceUnitId")
     * @Serializer\Accessor(getter="getBasePriceUnitId",setter="setBasePriceUnitId")
     */
    protected $basePriceUnitId = NULL;

    /**
     * @var Identity Unique product id
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("id")
     * @Serializer\Accessor(getter="getId",setter="setId")
     */
    protected $id = NULL;

    /**
     * @var Identity Reference to manufacturer
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("manufacturerId")
     * @Serializer\Accessor(getter="getManufacturerId",setter="setManufacturerId")
     */
    protected $manufacturerId = NULL;

    /**
     * @var Identity Reference to master product
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("masterProductId")
     * @Serializer\Accessor(getter="getMasterProductId",setter="setMasterProductId")
     */
    protected $masterProductId = NULL;

    /**
     * @var Identity Optional reference to measurement unit id
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("measurementUnitId")
     * @Serializer\Accessor(getter="getMeasurementUnitId",setter="setMeasurementUnitId")
     */
    protected $measurementUnitId = NULL;

    /**
     * @var Identity Optional reference to partsList
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("partsListId")
     * @Serializer\Accessor(getter="getPartsListId",setter="setPartsListId")
     */
    protected $partsListId = NULL;

    /**
     * @var Identity Optional reference to productType
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("productTypeId")
     * @Serializer\Accessor(getter="getProductTypeId",setter="setProductTypeId")
     */
    protected $productTypeId = NULL;

    /**
     * @var Identity Reference to shippingClass
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("shippingClassId")
     * @Serializer\Accessor(getter="getShippingClassId",setter="setShippingClassId")
     */
    protected $shippingClassId = NULL;

    /**
     * @var Identity Reference to unit
     * @Serializer\Type("jtl\Connector\Model\Identity")
     * @Serializer\SerializedName("unitId")
     * @Serializer\Accessor(getter="getUnitId",setter="setUnitId")
     */
    protected $unitId = NULL;

    /**
     * @var string Optional Amazon Standard Identification Number
     * @Serializer\Type("string")
     * @Serializer\SerializedName("asin")
     * @Serializer\Accessor(getter="getAsin",setter="setAsin")
     */
    protected $asin = '';

    /**
     * @var DateTime Optional available from date. Specify a date, upon when product can be purchased.
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("availableFrom")
     * @Serializer\Accessor(getter="getAvailableFrom",setter="setAvailableFrom")
     */
    protected $availableFrom = NULL;

    /**
     * @var float Optional base price divisor. Calculate basePriceDivisor by dividing product filling quantity through unit pricing base measure. E.g. 75ml / 100ml = 0.75
     * @Serializer\Type("double")
     * @Serializer\SerializedName("basePriceDivisor")
     * @Serializer\Accessor(getter="getBasePriceDivisor",setter="setBasePriceDivisor")
     */
    protected $basePriceDivisor = 0.0;

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("basePriceFactor")
     * @Serializer\Accessor(getter="getBasePriceFactor",setter="setBasePriceFactor")
     */
    protected $basePriceFactor = 0.0;

    /**
     * @var float Optional base price quantity
     * @Serializer\Type("double")
     * @Serializer\SerializedName("basePriceQuantity")
     * @Serializer\Accessor(getter="getBasePriceQuantity",setter="setBasePriceQuantity")
     */
    protected $basePriceQuantity = 0.0;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("basePriceUnitCode")
     * @Serializer\Accessor(getter="getBasePriceUnitCode",setter="setBasePriceUnitCode")
     */
    protected $basePriceUnitCode = '';

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("basePriceUnitName")
     * @Serializer\Accessor(getter="getBasePriceUnitName",setter="setBasePriceUnitName")
     */
    protected $basePriceUnitName = '';

    /**
     * @var bool Optional: Set to true to display base price / unit pricing measure
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("considerBasePrice")
     * @Serializer\Accessor(getter="getConsiderBasePrice",setter="setConsiderBasePrice")
     */
    protected $considerBasePrice = FALSE;

    /**
     * @var bool Consider stock level? If true, product can only be purchased with a positive stockLevel or when permitNegativeStock is set to true
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("considerStock")
     * @Serializer\Accessor(getter="getConsiderStock",setter="setConsiderStock")
     */
    protected $considerStock = FALSE;

    /**
     * @var bool Optional: Consider stock levels of productVariations. Same as considerStock but for variations.
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("considerVariationStock")
     * @Serializer\Accessor(getter="getConsiderVariationStock",setter="setConsiderVariationStock")
     */
    protected $considerVariationStock = FALSE;

    /**
     * @var DateTime Creation date
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("creationDate")
     * @Serializer\Accessor(getter="getCreationDate",setter="setCreationDate")
     */
    protected $creationDate = NULL;

    /**
     * @var string Optional European Article Number (EAN)
     * @Serializer\Type("string")
     * @Serializer\SerializedName("ean")
     * @Serializer\Accessor(getter="getEan",setter="setEan")
     */
    protected $ean = '';

    /**
     * @var string Optional Ebay product ID
     * @Serializer\Type("string")
     * @Serializer\SerializedName("epid")
     * @Serializer\Accessor(getter="getEpid",setter="setEpid")
     */
    protected $epid = '';

    /**
     * @var string Optional Hazard identifier, encodes general hazard class und subdivision
     * @Serializer\Type("string")
     * @Serializer\SerializedName("hazardIdNumber")
     * @Serializer\Accessor(getter="getHazardIdNumber",setter="setHazardIdNumber")
     */
    protected $hazardIdNumber = '';

    /**
     * @var float Optional product height
     * @Serializer\Type("double")
     * @Serializer\SerializedName("height")
     * @Serializer\Accessor(getter="getHeight",setter="setHeight")
     */
    protected $height = 0.0;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isActive")
     * @Serializer\Accessor(getter="getIsActive",setter="setIsActive")
     */
    protected $isActive = FALSE;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isBatch")
     * @Serializer\Accessor(getter="getIsBatch",setter="setIsBatch")
     */
    protected $isBatch = FALSE;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isBestBefore")
     * @Serializer\Accessor(getter="getIsBestBefore",setter="setIsBestBefore")
     */
    protected $isBestBefore = FALSE;

    /**
     * @var string Optional International Standard Book Number
     * @Serializer\Type("string")
     * @Serializer\SerializedName("isbn")
     * @Serializer\Accessor(getter="getIsbn",setter="setIsbn")
     */
    protected $isbn = '';

    /**
     * @var bool Optional: Set to true to allow non-integer quantites for purchase
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isDivisible")
     * @Serializer\Accessor(getter="getIsDivisible",setter="setIsDivisible")
     */
    protected $isDivisible = FALSE;

    /**
     * @var bool Optional flag if product is master product
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isMasterProduct")
     * @Serializer\Accessor(getter="getIsMasterProduct",setter="setIsMasterProduct")
     */
    protected $isMasterProduct = FALSE;

    /**
     * @var bool Optional flag new product. If true, product will be highlighted as new (creation date may also be considered)
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isNewProduct")
     * @Serializer\Accessor(getter="getisNewProduct",setter="setisNewProduct")
     */
    protected $isNewProduct = FALSE;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isSerialNumber")
     * @Serializer\Accessor(getter="getIsSerialNumber",setter="setIsSerialNumber")
     */
    protected $isSerialNumber = FALSE;

    /**
     * @var bool Optional flag top product. If true, product will be highlighted as top product (e.g. in product lists or in special boxes)
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("isTopProduct")
     * @Serializer\Accessor(getter="getIsTopProduct",setter="setIsTopProduct")
     */
    protected $isTopProduct = FALSE;

    /**
     * @var string Optional internal keywords and synonyms for product
     * @Serializer\Type("string")
     * @Serializer\SerializedName("keywords")
     * @Serializer\Accessor(getter="getKeywords",setter="setKeywords")
     */
    protected $keywords = '';

    /**
     * @var float Optional product length
     * @Serializer\Type("double")
     * @Serializer\SerializedName("length")
     * @Serializer\Accessor(getter="getLength",setter="setLength")
     */
    protected $length = 0.0;

    /**
     * @var string Optional manufacturer number
     * @Serializer\Type("string")
     * @Serializer\SerializedName("manufacturerNumber")
     * @Serializer\Accessor(getter="getManufacturerNumber",setter="setManufacturerNumber")
     */
    protected $manufacturerNumber = '';

    /**
     * @var \jtl\Connector\Model\Manufacturer
     * @Serializer\Type("jtl\Connector\Model\Manufacturer")
     * @Serializer\SerializedName("manufacturer")
     * @Serializer\Accessor(getter="getManufacturer",setter="setManufacturer")
     */
    protected $manufacturer = NULL;

    /**
     * @var float Optional measurement quantity
     * @Serializer\Type("double")
     * @Serializer\SerializedName("measurementQuantity")
     * @Serializer\Accessor(getter="getMeasurementQuantity",setter="setMeasurementQuantity")
     */
    protected $measurementQuantity = 0.0;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("measurementUnitCode")
     * @Serializer\Accessor(getter="getMeasurementUnitCode",setter="setMeasurementUnitCode")
     */
    protected $measurementUnitCode = '';

    /**
     * @var DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("minBestBeforeDate")
     * @Serializer\Accessor(getter="getMinBestBeforeDate",setter="setMinBestBeforeDate")
     */
    protected $minBestBeforeDate = NULL;

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("minimumOrderQuantity")
     * @Serializer\Accessor(getter="getMinimumOrderQuantity",setter="setMinimumOrderQuantity")
     */
    protected $minimumOrderQuantity = 0.0;

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("minimumQuantity")
     * @Serializer\Accessor(getter="getMinimumQuantity",setter="setMinimumQuantity")
     */
    protected $minimumQuantity = 0.0;

    /**
     * @var DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("modified")
     * @Serializer\Accessor(getter="getModified",setter="setModified")
     */
    protected $modified = NULL;

    /**
     * @var DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("newReleaseDate")
     * @Serializer\Accessor(getter="getNewReleaseDate",setter="setNewReleaseDate")
     */
    protected $newReleaseDate = NULL;

    /**
     * @var DateTime Contains the date of the next available inflow.
     * @Serializer\Type("DateTime")
     * @Serializer\SerializedName("nextAvailableInflowDate")
     * @Serializer\Accessor(getter="getNextAvailableInflowDate",setter="setNextAvailableInflowDate")
     */
    protected $nextAvailableInflowDate = NULL;

    /**
     * @var float Contains the quantity of the next available inflow.
     * @Serializer\Type("double")
     * @Serializer\SerializedName("nextAvailableInflowQuantity")
     * @Serializer\Accessor(getter="getNextAvailableInflowQuantity",setter="setNextAvailableInflowQuantity")
     */
    protected $nextAvailableInflowQuantity = 0.0;

    /**
     * @var string Optional internal product note
     * @Serializer\Type("string")
     * @Serializer\SerializedName("note")
     * @Serializer\Accessor(getter="getNote",setter="setNote")
     */
    protected $note = '';

    /**
     * @var string Optional Origin country
     * @Serializer\Type("string")
     * @Serializer\SerializedName("originCountry")
     * @Serializer\Accessor(getter="getOriginCountry",setter="setOriginCountry")
     */
    protected $originCountry = '';

    /**
     * @var float Optional: Product can only be purchased in multiples of takeOffQuantity e.g. 5,10,15...
     * @Serializer\Type("double")
     * @Serializer\SerializedName("packagingQuantity")
     * @Serializer\Accessor(getter="getPackagingQuantity",setter="setPackagingQuantity")
     */
    protected $packagingQuantity = 0.0;

    /**
     * @var bool Optional Permit negative stock / allow overselling. If true, product can be purchased even if stockLevel is less or equal 0 and considerStock is true.
     * @Serializer\Type("boolean")
     * @Serializer\SerializedName("permitNegativeStock")
     * @Serializer\Accessor(getter="getPermitNegativeStock",setter="setPermitNegativeStock")
     */
    protected $permitNegativeStock = FALSE;

    /**
     * @var float Productweight exclusive packaging
     * @Serializer\Type("double")
     * @Serializer\SerializedName("productWeight")
     * @Serializer\Accessor(getter="getProductWeight",setter="setProductWeight")
     */
    protected $productWeight = 0.0;

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("purchasePrice")
     * @Serializer\Accessor(getter="getPurchasePrice",setter="setPurchasePrice")
     */
    protected $purchasePrice = 0.0;

    /**
     * @var float Optional recommended retail price (gross)
     * @Serializer\Type("double")
     * @Serializer\SerializedName("recommendedRetailPrice")
     * @Serializer\Accessor(getter="getRecommendedRetailPrice",setter="setRecommendedRetailPrice")
     */
    protected $recommendedRetailPrice = 0.0;

    /**
     * @var string Optional serial number
     * @Serializer\Type("string")
     * @Serializer\SerializedName("serialNumber")
     * @Serializer\Accessor(getter="getSerialNumber",setter="setSerialNumber")
     */
    protected $serialNumber = '';

    /**
     * @var float Productweight inclusive packaging
     * @Serializer\Type("double")
     * @Serializer\SerializedName("shippingWeight")
     * @Serializer\Accessor(getter="getShippingWeight",setter="setShippingWeight")
     */
    protected $shippingWeight = 0.0;

    /**
     * @var string Optional stock keeping unit identifier
     * @Serializer\Type("string")
     * @Serializer\SerializedName("sku")
     * @Serializer\Accessor(getter="getSku",setter="setSku")
     */
    protected $sku = '';

    /**
     * @var int Optional sort number for product sorting in lists
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("sort")
     * @Serializer\Accessor(getter="getSort",setter="setSort")
     */
    protected $sort = 0;

    /**
     * @var ProductStockLevel
     * @Serializer\Type("jtl\Connector\Model\ProductStockLevel")
     * @Serializer\SerializedName("stockLevel")
     * @Serializer\Accessor(getter="getStockLevel",setter="setStockLevel")
     */
    protected $stockLevel = NULL;

    /**
     * @var int
     * @Serializer\Type("integer")
     * @Serializer\SerializedName("supplierDeliveryTime")
     * @Serializer\Accessor(getter="getSupplierDeliveryTime",setter="setSupplierDeliveryTime")
     */
    protected $supplierDeliveryTime = 0;

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("supplierStockLevel")
     * @Serializer\Accessor(getter="getSupplierStockLevel",setter="setSupplierStockLevel")
     */
    protected $supplierStockLevel = 0.0;

    /**
     * @var string Optional TARIC
     * @Serializer\Type("string")
     * @Serializer\SerializedName("taric")
     * @Serializer\Accessor(getter="getTaric",setter="setTaric")
     */
    protected $taric = '';

    /**
     * @var string Optional UN number, used to define hazardous properties
     * @Serializer\Type("string")
     * @Serializer\SerializedName("unNumber")
     * @Serializer\Accessor(getter="getUnNumber",setter="setUnNumber")
     */
    protected $unNumber = '';

    /**
     * @var string Optional Universal Product Code
     * @Serializer\Type("string")
     * @Serializer\SerializedName("upc")
     * @Serializer\Accessor(getter="getUpc",setter="setUpc")
     */
    protected $upc = '';

    /**
     * @var float
     * @Serializer\Type("double")
     * @Serializer\SerializedName("vat")
     * @Serializer\Accessor(getter="getVat",setter="setVat")
     */
    protected $vat = 0.0;

    /**
     * @var float Optional product width
     * @Serializer\Type("double")
     * @Serializer\SerializedName("width")
     * @Serializer\Accessor(getter="getWidth",setter="setWidth")
     */
    protected $width = 0.0;

    /**
     * @var \jtl\Connector\Model\ProductAttr[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductAttr>")
     * @Serializer\SerializedName("attributes")
     * @Serializer\AccessType("reflection")
     */
    protected $attributes = [];

    /**
     * @var \jtl\Connector\Model\Product2Category[]
     * @Serializer\Type("array<jtl\Connector\Model\Product2Category>")
     * @Serializer\SerializedName("categories")
     * @Serializer\AccessType("reflection")
     */
    protected $categories = [];

    /**
     * @var \jtl\Connector\Model\ProductChecksum[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductChecksum>")
     * @Serializer\SerializedName("checksums")
     * @Serializer\AccessType("reflection")
     */
    protected $checksums = [];

    /**
     * @var \jtl\Connector\Model\ProductConfigGroup[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductConfigGroup>")
     * @Serializer\SerializedName("configGroups")
     * @Serializer\AccessType("reflection")
     */
    protected $configGroups = [];

    /**
     * @var \jtl\Connector\Model\CustomerGroupPackagingQuantity[]
     * @Serializer\Type("array<jtl\Connector\Model\CustomerGroupPackagingQuantity>")
     * @Serializer\SerializedName("customerGroupPackagingQuantities")
     * @Serializer\AccessType("reflection")
     */
    protected $customerGroupPackagingQuantities = [];

    /**
     * @var \jtl\Connector\Model\ProductFileDownload[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductFileDownload>")
     * @Serializer\SerializedName("fileDownloads")
     * @Serializer\AccessType("reflection")
     */
    protected $fileDownloads = [];

    /**
     * @var \jtl\Connector\Model\ProductI18n[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductI18n>")
     * @Serializer\SerializedName("i18ns")
     * @Serializer\AccessType("reflection")
     */
    protected $i18ns = [];

    /**
     * @var \jtl\Connector\Model\ProductInvisibility[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductInvisibility>")
     * @Serializer\SerializedName("invisibilities")
     * @Serializer\AccessType("reflection")
     */
    protected $invisibilities = [];

    /**
     * @var \jtl\Connector\Model\ProductMediaFile[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductMediaFile>")
     * @Serializer\SerializedName("mediaFiles")
     * @Serializer\AccessType("reflection")
     */
    protected $mediaFiles = [];

    /**
     * @var \jtl\Connector\Model\ProductPartsList[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductPartsList>")
     * @Serializer\SerializedName("partsLists")
     * @Serializer\AccessType("reflection")
     */
    protected $partsLists = [];

    /**
     * @var \jtl\Connector\Model\ProductPrice[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductPrice>")
     * @Serializer\SerializedName("prices")
     * @Serializer\AccessType("reflection")
     */
    protected $prices = [];

    /**
     * @var \jtl\Connector\Model\ProductSpecialPrice[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductSpecialPrice>")
     * @Serializer\SerializedName("specialPrices")
     * @Serializer\AccessType("reflection")
     */
    protected $specialPrices = [];

    /**
     * @var \jtl\Connector\Model\ProductSpecific[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductSpecific>")
     * @Serializer\SerializedName("specifics")
     * @Serializer\AccessType("reflection")
     */
    protected $specifics = [];

    /**
     * @var \jtl\Connector\Model\ProductVarCombination[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductVarCombination>")
     * @Serializer\SerializedName("varCombinations")
     * @Serializer\AccessType("reflection")
     */
    protected $varCombinations = [];

    /**
     * @var \jtl\Connector\Model\ProductVariation[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductVariation>")
     * @Serializer\SerializedName("variations")
     * @Serializer\AccessType("reflection")
     */
    protected $variations = [];

    /**
     * @var \jtl\Connector\Model\ProductWarehouseInfo[]
     * @Serializer\Type("array<jtl\Connector\Model\ProductWarehouseInfo>")
     * @Serializer\SerializedName("warehouseInfo")
     * @Serializer\AccessType("reflection")
     */
    protected $warehouseInfo = [];

    /**
     * Constructor.
     */
    public function __construct() {
        $this->id = new Identity();
        $this->shippingClassId = new Identity();
        $this->masterProductId = new Identity();
        $this->partsListId = new Identity();
        $this->productTypeId = new Identity();
        $this->manufacturerId = new Identity();
        $this->measurementUnitId = new Identity();
        $this->basePriceUnitId = new Identity();
        $this->unitId = new Identity();
    }

    /**
     * @param Identity $basePriceUnitId Optional reference to basePriceUnit
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setBasePriceUnitId(Identity $basePriceUnitId) {
        return $this->setProperty('basePriceUnitId', $basePriceUnitId, 'Identity');
    }

    /**
     * @return Identity Optional reference to basePriceUnit
     */
    public function getBasePriceUnitId() {
        return $this->basePriceUnitId;
    }

    /**
     * @param Identity $id Unique product id
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setId(Identity $id) {
        return $this->setProperty('id', $id, 'Identity');
    }

    /**
     * @return Identity Unique product id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param Identity $manufacturerId Reference to manufacturer
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setManufacturerId(Identity $manufacturerId) {
        return $this->setProperty('manufacturerId', $manufacturerId, 'Identity');
    }

    /**
     * @return Identity Reference to manufacturer
     */
    public function getManufacturerId() {
        return $this->manufacturerId;
    }

    /**
     * @param Identity $masterProductId Reference to master product
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setMasterProductId(Identity $masterProductId) {
        return $this->setProperty('masterProductId', $masterProductId, 'Identity');
    }

    /**
     * @return Identity Reference to master product
     */
    public function getMasterProductId() {
        return $this->masterProductId;
    }

    /**
     * @param Identity $measurementUnitId Optional reference to measurement unit id
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setMeasurementUnitId(Identity $measurementUnitId) {
        return $this->setProperty('measurementUnitId', $measurementUnitId, 'Identity');
    }

    /**
     * @return Identity Optional reference to measurement unit id
     */
    public function getMeasurementUnitId() {
        return $this->measurementUnitId;
    }

    /**
     * @param Identity $partsListId Optional reference to partsList
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setPartsListId(Identity $partsListId) {
        return $this->setProperty('partsListId', $partsListId, 'Identity');
    }

    /**
     * @return Identity Optional reference to partsList
     */
    public function getPartsListId() {
        return $this->partsListId;
    }

    /**
     * @param Identity $productTypeId Optional reference to productType
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setProductTypeId(Identity $productTypeId) {
        return $this->setProperty('productTypeId', $productTypeId, 'Identity');
    }

    /**
     * @return Identity Optional reference to productType
     */
    public function getProductTypeId() {
        return $this->productTypeId;
    }

    /**
     * @param Identity $shippingClassId Reference to shippingClass
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setShippingClassId(Identity $shippingClassId) {
        return $this->setProperty('shippingClassId', $shippingClassId, 'Identity');
    }

    /**
     * @return Identity Reference to shippingClass
     */
    public function getShippingClassId() {
        return $this->shippingClassId;
    }

    /**
     * @param Identity $unitId Reference to unit
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'Identity'.
     */
    public function setUnitId(Identity $unitId) {
        return $this->setProperty('unitId', $unitId, 'Identity');
    }

    /**
     * @return Identity Reference to unit
     */
    public function getUnitId() {
        return $this->unitId;
    }

    /**
     * @param string $asin Optional Amazon Standard Identification Number
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setAsin($asin) {
        return $this->setProperty('asin', $asin, 'string');
    }

    /**
     * @return string Optional Amazon Standard Identification Number
     */
    public function getAsin() {
        return $this->asin;
    }

    /**
     * @param DateTime $availableFrom Optional available from date. Specify a date, upon when product can be purchased.
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setAvailableFrom(DateTime $availableFrom = NULL) {
        return $this->setProperty('availableFrom', $availableFrom, 'DateTime');
    }

    /**
     * @return DateTime Optional available from date. Specify a date, upon when product can be purchased.
     */
    public function getAvailableFrom() {
        return $this->availableFrom;
    }

    /**
     * @param float $basePriceDivisor Optional base price divisor. Calculate basePriceDivisor by dividing product filling quantity through unit pricing base measure. E.g. 75ml / 100ml = 0.75
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setBasePriceDivisor($basePriceDivisor) {
        return $this->setProperty('basePriceDivisor', $basePriceDivisor, 'double');
    }

    /**
     * @return float Optional base price divisor. Calculate basePriceDivisor by dividing product filling quantity through unit pricing base measure. E.g. 75ml / 100ml = 0.75
     */
    public function getBasePriceDivisor() {
        return $this->basePriceDivisor;
    }

    /**
     * @param float $basePriceFactor
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setBasePriceFactor($basePriceFactor) {
        return $this->setProperty('basePriceFactor', $basePriceFactor, 'double');
    }

    /**
     * @return float
     */
    public function getBasePriceFactor() {
        return $this->basePriceFactor;
    }

    /**
     * @param float $basePriceQuantity Optional base price quantity
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setBasePriceQuantity($basePriceQuantity) {
        return $this->setProperty('basePriceQuantity', $basePriceQuantity, 'double');
    }

    /**
     * @return float Optional base price quantity
     */
    public function getBasePriceQuantity() {
        return $this->basePriceQuantity;
    }

    /**
     * @param string $basePriceUnitCode
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setBasePriceUnitCode($basePriceUnitCode) {
        return $this->setProperty('basePriceUnitCode', $basePriceUnitCode, 'string');
    }

    /**
     * @return string
     */
    public function getBasePriceUnitCode() {
        return $this->basePriceUnitCode;
    }

    /**
     * @param string $basePriceUnitName
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setBasePriceUnitName($basePriceUnitName) {
        return $this->setProperty('basePriceUnitName', $basePriceUnitName, 'string');
    }

    /**
     * @return string
     */
    public function getBasePriceUnitName() {
        return $this->basePriceUnitName;
    }

    /**
     * @param bool $considerBasePrice Optional: Set to true to display base price / unit pricing measure
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setConsiderBasePrice($considerBasePrice) {
        return $this->setProperty('considerBasePrice', $considerBasePrice, 'boolean');
    }

    /**
     * @return bool Optional: Set to true to display base price / unit pricing measure
     */
    public function getConsiderBasePrice() {
        return $this->considerBasePrice;
    }

    /**
     * @param bool $considerStock Consider stock level? If true, product can only be purchased with a positive stockLevel or when permitNegativeStock is set to true
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setConsiderStock($considerStock) {
        return $this->setProperty('considerStock', $considerStock, 'boolean');
    }

    /**
     * @return bool Consider stock level? If true, product can only be purchased with a positive stockLevel or when permitNegativeStock is set to true
     */
    public function getConsiderStock() {
        return $this->considerStock;
    }

    /**
     * @param bool $considerVariationStock Optional: Consider stock levels of productVariations. Same as considerStock but for variations.
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setConsiderVariationStock($considerVariationStock) {
        return $this->setProperty('considerVariationStock', $considerVariationStock, 'boolean');
    }

    /**
     * @return bool Optional: Consider stock levels of productVariations. Same as considerStock but for variations.
     */
    public function getConsiderVariationStock() {
        return $this->considerVariationStock;
    }

    /**
     * @param DateTime $creationDate Creation date
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setCreationDate(DateTime $creationDate = NULL) {
        return $this->setProperty('creationDate', $creationDate, 'DateTime');
    }

    /**
     * @return DateTime Creation date
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * @param string $ean Optional European Article Number (EAN)
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setEan($ean) {
        return $this->setProperty('ean', $ean, 'string');
    }

    /**
     * @return string Optional European Article Number (EAN)
     */
    public function getEan() {
        return $this->ean;
    }

    /**
     * @param string $epid Optional Ebay product ID
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setEpid($epid) {
        return $this->setProperty('epid', $epid, 'string');
    }

    /**
     * @return string Optional Ebay product ID
     */
    public function getEpid() {
        return $this->epid;
    }

    /**
     * @param string $hazardIdNumber Optional Hazard identifier, encodes general hazard class und subdivision
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setHazardIdNumber($hazardIdNumber) {
        return $this->setProperty('hazardIdNumber', $hazardIdNumber, 'string');
    }

    /**
     * @return string Optional Hazard identifier, encodes general hazard class und subdivision
     */
    public function getHazardIdNumber() {
        return $this->hazardIdNumber;
    }

    /**
     * @param float $height Optional product height
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setHeight($height) {
        return $this->setProperty('height', $height, 'double');
    }

    /**
     * @return float Optional product height
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param bool $isActive
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsActive($isActive) {
        return $this->setProperty('isActive', $isActive, 'boolean');
    }

    /**
     * @return bool
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * @param bool $isBatch
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsBatch($isBatch) {
        return $this->setProperty('isBatch', $isBatch, 'boolean');
    }

    /**
     * @return bool
     */
    public function getIsBatch() {
        return $this->isBatch;
    }

    /**
     * @param bool $isBestBefore
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsBestBefore($isBestBefore) {
        return $this->setProperty('isBestBefore', $isBestBefore, 'boolean');
    }

    /**
     * @return bool
     */
    public function getIsBestBefore() {
        return $this->isBestBefore;
    }

    /**
     * @param string $isbn Optional International Standard Book Number
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsbn($isbn) {
        return $this->setProperty('isbn', $isbn, 'string');
    }

    /**
     * @return string Optional International Standard Book Number
     */
    public function getIsbn() {
        return $this->isbn;
    }

    /**
     * @param bool $isDivisible Optional: Set to true to allow non-integer quantites for purchase
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsDivisible($isDivisible) {
        return $this->setProperty('isDivisible', $isDivisible, 'boolean');
    }

    /**
     * @return bool Optional: Set to true to allow non-integer quantites for purchase
     */
    public function getIsDivisible() {
        return $this->isDivisible;
    }

    /**
     * @param bool $isMasterProduct Optional flag if product is master product
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsMasterProduct($isMasterProduct) {
        return $this->setProperty('isMasterProduct', $isMasterProduct, 'boolean');
    }

    /**
     * @return bool Optional flag if product is master product
     */
    public function getIsMasterProduct() {
        return $this->isMasterProduct;
    }

    /**
     * @param bool $isNewProduct Optional flag new product. If true, product will be highlighted as new (creation date may also be considered)
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setisNewProduct($isNewProduct) {
        return $this->setProperty('isNewProduct', $isNewProduct, 'boolean');
    }

    /**
     * @return bool Optional flag new product. If true, product will be highlighted as new (creation date may also be considered)
     */
    public function getisNewProduct() {
        return $this->isNewProduct;
    }

    /**
     * @param bool $isSerialNumber
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsSerialNumber($isSerialNumber) {
        return $this->setProperty('isSerialNumber', $isSerialNumber, 'boolean');
    }

    /**
     * @return bool
     */
    public function getIsSerialNumber() {
        return $this->isSerialNumber;
    }

    /**
     * @param bool $isTopProduct Optional flag top product. If true, product will be highlighted as top product (e.g. in product lists or in special boxes)
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setIsTopProduct($isTopProduct) {
        return $this->setProperty('isTopProduct', $isTopProduct, 'boolean');
    }

    /**
     * @return bool Optional flag top product. If true, product will be highlighted as top product (e.g. in product lists or in special boxes)
     */
    public function getIsTopProduct() {
        return $this->isTopProduct;
    }

    /**
     * @param string $keywords Optional internal keywords and synonyms for product
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setKeywords($keywords) {
        return $this->setProperty('keywords', $keywords, 'string');
    }

    /**
     * @return string Optional internal keywords and synonyms for product
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     * @param float $length Optional product length
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setLength($length) {
        return $this->setProperty('length', $length, 'double');
    }

    /**
     * @return float Optional product length
     */
    public function getLength() {
        return $this->length;
    }

    /**
     * @param string $manufacturerNumber Optional manufacturer number
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setManufacturerNumber($manufacturerNumber) {
        return $this->setProperty('manufacturerNumber', $manufacturerNumber, 'string');
    }

    /**
     * @return string Optional manufacturer number
     */
    public function getManufacturerNumber() {
        return $this->manufacturerNumber;
    }

    /**
     * @param string $manufacturer Optional manufacturer
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setManufacturer(Manufacturer $manufacturer = NULL) {
        return $this->setProperty('manufacturer', $manufacturer, 'jtl\Connector\Model\Manufacturer');
    }

    /**
     * @return \jtl\Connector\Model\Manufacturer|null Optional manufacturer
     */
    public function getManufacturer() {
        return $this->manufacturer;
    }

    /**
     * @param float $measurementQuantity Optional measurement quantity
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setMeasurementQuantity($measurementQuantity) {
        return $this->setProperty('measurementQuantity', $measurementQuantity, 'double');
    }

    /**
     * @return float Optional measurement quantity
     */
    public function getMeasurementQuantity() {
        return $this->measurementQuantity;
    }

    /**
     * @param string $measurementUnitCode
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setMeasurementUnitCode($measurementUnitCode) {
        return $this->setProperty('measurementUnitCode', $measurementUnitCode, 'string');
    }

    /**
     * @return string
     */
    public function getMeasurementUnitCode() {
        return $this->measurementUnitCode;
    }

    /**
     * @param DateTime $minBestBeforeDate
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setMinBestBeforeDate(DateTime $minBestBeforeDate = NULL) {
        return $this->setProperty('minBestBeforeDate', $minBestBeforeDate, 'DateTime');
    }

    /**
     * @return DateTime
     */
    public function getMinBestBeforeDate() {
        return $this->minBestBeforeDate;
    }

    /**
     * @param float $minimumOrderQuantity
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setMinimumOrderQuantity($minimumOrderQuantity) {
        return $this->setProperty('minimumOrderQuantity', $minimumOrderQuantity, 'double');
    }

    /**
     * @return float
     */
    public function getMinimumOrderQuantity() {
        return $this->minimumOrderQuantity;
    }

    /**
     * @param float $minimumQuantity
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setMinimumQuantity($minimumQuantity) {
        return $this->setProperty('minimumQuantity', $minimumQuantity, 'double');
    }

    /**
     * @return float
     */
    public function getMinimumQuantity() {
        return $this->minimumQuantity;
    }

    /**
     * @param DateTime $modified
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setModified(DateTime $modified = NULL) {
        return $this->setProperty('modified', $modified, 'DateTime');
    }

    /**
     * @return DateTime
     */
    public function getModified() {
        return $this->modified;
    }

    /**
     * @param DateTime $newReleaseDate
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setNewReleaseDate(DateTime $newReleaseDate = NULL) {
        return $this->setProperty('newReleaseDate', $newReleaseDate, 'DateTime');
    }

    /**
     * @return DateTime
     */
    public function getNewReleaseDate() {
        return $this->newReleaseDate;
    }

    /**
     * @param DateTime $nextAvailableInflowDate Contains the date of the next available inflow.
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'DateTime'.
     */
    public function setNextAvailableInflowDate(DateTime $nextAvailableInflowDate = NULL) {
        return $this->setProperty('nextAvailableInflowDate', $nextAvailableInflowDate, 'DateTime');
    }

    /**
     * @return DateTime Contains the date of the next available inflow.
     */
    public function getNextAvailableInflowDate() {
        return $this->nextAvailableInflowDate;
    }

    /**
     * @param float $nextAvailableInflowQuantity Contains the quantity of the next available inflow.
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setNextAvailableInflowQuantity($nextAvailableInflowQuantity) {
        return $this->setProperty('nextAvailableInflowQuantity', $nextAvailableInflowQuantity, 'double');
    }

    /**
     * @return float Contains the quantity of the next available inflow.
     */
    public function getNextAvailableInflowQuantity() {
        return $this->nextAvailableInflowQuantity;
    }

    /**
     * @param string $note Optional internal product note
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setNote($note) {
        return $this->setProperty('note', $note, 'string');
    }

    /**
     * @return string Optional internal product note
     */
    public function getNote() {
        return $this->note;
    }

    /**
     * @param string $originCountry Optional Origin country
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setOriginCountry($originCountry) {
        return $this->setProperty('originCountry', $originCountry, 'string');
    }

    /**
     * @return string Optional Origin country
     */
    public function getOriginCountry() {
        return $this->originCountry;
    }

    /**
     * @param float $packagingQuantity Optional: Product can only be purchased in multiples of takeOffQuantity e.g. 5,10,15...
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setPackagingQuantity($packagingQuantity) {
        return $this->setProperty('packagingQuantity', $packagingQuantity, 'double');
    }

    /**
     * @return float Optional: Product can only be purchased in multiples of takeOffQuantity e.g. 5,10,15...
     */
    public function getPackagingQuantity() {
        return $this->packagingQuantity;
    }

    /**
     * @param bool $permitNegativeStock Optional Permit negative stock / allow overselling. If true, product can be purchased even if stockLevel is less or equal 0 and considerStock is true.
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setPermitNegativeStock($permitNegativeStock) {
        return $this->setProperty('permitNegativeStock', $permitNegativeStock, 'boolean');
    }

    /**
     * @return bool Optional Permit negative stock / allow overselling. If true, product can be purchased even if stockLevel is less or equal 0 and considerStock is true.
     */
    public function getPermitNegativeStock() {
        return $this->permitNegativeStock;
    }

    /**
     * @param float $productWeight Productweight exclusive packaging
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setProductWeight($productWeight) {
        return $this->setProperty('productWeight', $productWeight, 'double');
    }

    /**
     * @return float Productweight exclusive packaging
     */
    public function getProductWeight() {
        return $this->productWeight;
    }

    /**
     * @param float $purchasePrice
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setPurchasePrice($purchasePrice) {
        return $this->setProperty('purchasePrice', $purchasePrice, 'double');
    }

    /**
     * @return float
     */
    public function getPurchasePrice() {
        return $this->purchasePrice;
    }

    /**
     * @param float $recommendedRetailPrice Optional recommended retail price (gross)
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setRecommendedRetailPrice($recommendedRetailPrice) {
        return $this->setProperty('recommendedRetailPrice', $recommendedRetailPrice, 'double');
    }

    /**
     * @return float Optional recommended retail price (gross)
     */
    public function getRecommendedRetailPrice() {
        return $this->recommendedRetailPrice;
    }

    /**
     * @param string $serialNumber Optional serial number
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSerialNumber($serialNumber) {
        return $this->setProperty('serialNumber', $serialNumber, 'string');
    }

    /**
     * @return string Optional serial number
     */
    public function getSerialNumber() {
        return $this->serialNumber;
    }

    /**
     * @param float $shippingWeight Productweight inclusive packaging
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setShippingWeight($shippingWeight) {
        return $this->setProperty('shippingWeight', $shippingWeight, 'double');
    }

    /**
     * @return float Productweight inclusive packaging
     */
    public function getShippingWeight() {
        return $this->shippingWeight;
    }

    /**
     * @param string $sku Optional stock keeping unit identifier
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSku($sku) {
        return $this->setProperty('sku', $sku, 'string');
    }

    /**
     * @return string Optional stock keeping unit identifier
     */
    public function getSku() {
        return $this->sku;
    }

    /**
     * @param int $sort Optional sort number for product sorting in lists
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSort($sort) {
        return $this->setProperty('sort', $sort, 'integer');
    }

    /**
     * @return int Optional sort number for product sorting in lists
     */
    public function getSort() {
        return $this->sort;
    }

    /**
     * @param ProductStockLevel $stockLevel
     *
     * @return \jtl\Connector\Model\Product
     *
     * @throws InvalidArgumentException if the provided argument is not of type 'ProductStockLevel'.
     */
    public function setStockLevel(ProductStockLevel $stockLevel = NULL) {
        return $this->setProperty('stockLevel', $stockLevel, 'jtl\Connector\Model\ProductStockLevel');
    }

    /**
     * @return \jtl\Connector\Model\ProductStockLevel
     */
    public function getStockLevel() {
        return $this->stockLevel;
    }

    /**
     * @param int $supplierDeliveryTime
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSupplierDeliveryTime($supplierDeliveryTime) {
        return $this->setProperty('supplierDeliveryTime', $supplierDeliveryTime, 'integer');
    }

    /**
     * @return int
     */
    public function getSupplierDeliveryTime() {
        return $this->supplierDeliveryTime;
    }

    /**
     * @param float $supplierStockLevel
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSupplierStockLevel($supplierStockLevel) {
        return $this->setProperty('supplierStockLevel', $supplierStockLevel, 'double');
    }

    /**
     * @return float
     */
    public function getSupplierStockLevel() {
        return $this->supplierStockLevel;
    }

    /**
     * @param string $taric Optional TARIC
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setTaric($taric) {
        return $this->setProperty('taric', $taric, 'string');
    }

    /**
     * @return string Optional TARIC
     */
    public function getTaric() {
        return $this->taric;
    }

    /**
     * @param string $unNumber Optional UN number, used to define hazardous properties
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setUnNumber($unNumber) {
        return $this->setProperty('unNumber', $unNumber, 'string');
    }

    /**
     * @return string Optional UN number, used to define hazardous properties
     */
    public function getUnNumber() {
        return $this->unNumber;
    }

    /**
     * @param string $upc Optional Universal Product Code
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setUpc($upc) {
        return $this->setProperty('upc', $upc, 'string');
    }

    /**
     * @return string Optional Universal Product Code
     */
    public function getUpc() {
        return $this->upc;
    }

    /**
     * @param float $vat
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setVat($vat) {
        return $this->setProperty('vat', $vat, 'double');
    }

    /**
     * @return float
     */
    public function getVat() {
        return $this->vat;
    }

    /**
     * @param float $width Optional product width
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setWidth($width) {
        return $this->setProperty('width', $width, 'double');
    }

    /**
     * @return float Optional product width
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param \jtl\Connector\Model\ProductAttr $attribute
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addAttribute(\jtl\Connector\Model\ProductAttr $attribute) {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setAttributes(array $attributes) {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductAttr[]
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearAttributes() {
        $this->attributes = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\Product2Category $category
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addCategory(\jtl\Connector\Model\Product2Category $category) {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param array $categories
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setCategories(array $categories) {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\Product2Category[]
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearCategories() {
        $this->categories = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductChecksum $checksum
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addChecksum(\jtl\Connector\Model\ProductChecksum $checksum) {
        $this->checksums[] = $checksum;

        return $this;
    }

    /**
     * @param array $checksums
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setChecksums(array $checksums) {
        $this->checksums = $checksums;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductChecksum[]
     */
    public function getChecksums() {
        return $this->checksums;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearChecksums() {
        $this->checksums = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductConfigGroup $configGroup
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addConfigGroup(\jtl\Connector\Model\ProductConfigGroup $configGroup) {
        $this->configGroups[] = $configGroup;

        return $this;
    }

    /**
     * @param array $configGroups
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setConfigGroups(array $configGroups) {
        $this->configGroups = $configGroups;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductConfigGroup[]
     */
    public function getConfigGroups() {
        return $this->configGroups;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearConfigGroups() {
        $this->configGroups = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\CustomerGroupPackagingQuantity $customerGroupPackagingQuantity
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addCustomerGroupPackagingQuantity(\jtl\Connector\Model\CustomerGroupPackagingQuantity $customerGroupPackagingQuantity) {
        $this->customerGroupPackagingQuantities[] = $customerGroupPackagingQuantity;

        return $this;
    }

    /**
     * @param array $customerGroupPackagingQuantities
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setCustomerGroupPackagingQuantities(array $customerGroupPackagingQuantities) {
        $this->customerGroupPackagingQuantities = $customerGroupPackagingQuantities;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\CustomerGroupPackagingQuantity[]
     */
    public function getCustomerGroupPackagingQuantities() {
        return $this->customerGroupPackagingQuantities;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearCustomerGroupPackagingQuantities() {
        $this->customerGroupPackagingQuantities = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductFileDownload $fileDownload
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addFileDownload(\jtl\Connector\Model\ProductFileDownload $fileDownload) {
        $this->fileDownloads[] = $fileDownload;

        return $this;
    }

    /**
     * @param array $fileDownloads
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setFileDownloads(array $fileDownloads) {
        $this->fileDownloads = $fileDownloads;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductFileDownload[]
     */
    public function getFileDownloads() {
        return $this->fileDownloads;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearFileDownloads() {
        $this->fileDownloads = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductI18n $i18n
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addI18n(\jtl\Connector\Model\ProductI18n $i18n) {
        $this->i18ns[] = $i18n;

        return $this;
    }

    /**
     * @param array $i18ns
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setI18ns(array $i18ns) {
        $this->i18ns = $i18ns;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductI18n[]
     */
    public function getI18ns() {
        return $this->i18ns;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearI18ns() {
        $this->i18ns = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductInvisibility $invisibility
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addInvisibility(\jtl\Connector\Model\ProductInvisibility $invisibility) {
        $this->invisibilities[] = $invisibility;

        return $this;
    }

    /**
     * @param array $invisibilities
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setInvisibilities(array $invisibilities) {
        $this->invisibilities = $invisibilities;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductInvisibility[]
     */
    public function getInvisibilities() {
        return $this->invisibilities;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearInvisibilities() {
        $this->invisibilities = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductMediaFile $mediaFile
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addMediaFile(\jtl\Connector\Model\ProductMediaFile $mediaFile) {
        $this->mediaFiles[] = $mediaFile;

        return $this;
    }

    /**
     * @param array $mediaFiles
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setMediaFiles(array $mediaFiles) {
        $this->mediaFiles = $mediaFiles;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductMediaFile[]
     */
    public function getMediaFiles() {
        return $this->mediaFiles;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearMediaFiles() {
        $this->mediaFiles = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductPartsList $partsList
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addPartsList(\jtl\Connector\Model\ProductPartsList $partsList) {
        $this->partsLists[] = $partsList;

        return $this;
    }

    /**
     * @param array $partsLists
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setPartsLists(array $partsLists) {
        $this->partsLists = $partsLists;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductPartsList[]
     */
    public function getPartsLists() {
        return $this->partsLists;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearPartsLists() {
        $this->partsLists = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductPrice $price
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addPrice(\jtl\Connector\Model\ProductPrice $price) {
        $this->prices[] = $price;

        return $this;
    }

    /**
     * @param array $prices
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setPrices(array $prices) {
        $this->prices = $prices;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductPrice[]
     */
    public function getPrices() {
        return $this->prices;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearPrices() {
        $this->prices = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductSpecialPrice $specialPrice
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addSpecialPrice(\jtl\Connector\Model\ProductSpecialPrice $specialPrice) {
        $this->specialPrices[] = $specialPrice;

        return $this;
    }

    /**
     * @param array $specialPrices
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSpecialPrices(array $specialPrices) {
        $this->specialPrices = $specialPrices;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductSpecialPrice[]
     */
    public function getSpecialPrices() {
        return $this->specialPrices;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearSpecialPrices() {
        $this->specialPrices = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductSpecific $specific
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addSpecific(\jtl\Connector\Model\ProductSpecific $specific) {
        $this->specifics[] = $specific;

        return $this;
    }

    /**
     * @param array $specifics
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setSpecifics(array $specifics) {
        $this->specifics = $specifics;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductSpecific[]
     */
    public function getSpecifics() {
        return $this->specifics;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearSpecifics() {
        $this->specifics = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductVarCombination $varCombination
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addVarCombination(\jtl\Connector\Model\ProductVarCombination $varCombination) {
        $this->varCombinations[] = $varCombination;

        return $this;
    }

    /**
     * @param array $varCombinations
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setVarCombinations(array $varCombinations) {
        $this->varCombinations = $varCombinations;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductVarCombination[]
     */
    public function getVarCombinations() {
        return $this->varCombinations;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearVarCombinations() {
        $this->varCombinations = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductVariation $variation
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addVariation(\jtl\Connector\Model\ProductVariation $variation) {
        $this->variations[] = $variation;

        return $this;
    }

    /**
     * @param array $variations
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setVariations(array $variations) {
        $this->variations = $variations;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductVariation[]
     */
    public function getVariations() {
        return $this->variations;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearVariations() {
        $this->variations = [];

        return $this;
    }

    /**
     * @param \jtl\Connector\Model\ProductWarehouseInfo $warehouseInfo
     *
     * @return \jtl\Connector\Model\Product
     */
    public function addWarehouseInfo(\jtl\Connector\Model\ProductWarehouseInfo $warehouseInfo) {
        $this->warehouseInfo[] = $warehouseInfo;

        return $this;
    }

    /**
     * @param array $warehouseInfo
     *
     * @return \jtl\Connector\Model\Product
     */
    public function setWarehouseInfo(array $warehouseInfo) {
        $this->warehouseInfo = $warehouseInfo;

        return $this;
    }

    /**
     * @return \jtl\Connector\Model\ProductWarehouseInfo[]
     */
    public function getWarehouseInfo() {
        return $this->warehouseInfo;
    }

    /**
     * @return \jtl\Connector\Model\Product
     */
    public function clearWarehouseInfo() {
        $this->warehouseInfo = [];

        return $this;
    }
}
