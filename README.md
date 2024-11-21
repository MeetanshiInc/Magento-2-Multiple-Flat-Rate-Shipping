# **Magento 2 Multiple Flat Rate Shipping**

**Magento 2 Multiple Flat Rate Shipping** Extension simplifies shipping operations by allowing store owners to create multiple flat rate shipping methods. 

This feature-rich extension provides flexibility to set up shipping rates based on customer requirements and business needs, ensuring an improved shopping experience.

## **How It Works**

The extension enables merchants to configure multiple flat-rate shipping methods with ease. You can define shipping rates for different customer groups or geographical regions, ensuring tailored shipping options. Once set up, customers can select the most suitable shipping method during checkout.

## **Key Features**

* Configure unlimited flat rate shipping methods.  
* Assign shipping rates based on cart conditions or customer groups.  
* Enable or disable shipping methods as required.  
* Add a unique title, method name, and price for each flat rate.

### **Flexible Shipping Configuration**

Create and customize multiple shipping rates easily \- name them, add descriptions, and set flexible pricing per order or item to match your needs.

### **Region-Specific Shipping**

Customize shipping options by location \- set specific rates and methods for different countries and regions to optimize delivery costs.

### **Customer Group Targeting**

Offer personalized shipping prices for different customer segments \- from special rates for loyal shoppers to exclusive pricing for wholesale buyers.

### **Seamless Checkout Experience**

Give customers choice at checkout \- display multiple flat rate shipping methods so they can select what works best for them.

## **Extension Installation**

To install the Magento 2 Multiple Flat Rate Shipping extension:

### **Step 1:** 

Extract the zip folder and upload our extension to the root of your Magento 2 directory via FTP.

### **Step 2:**

### Login to your SSH and run below commands step by step:

* php bin/magento setup:upgrade  
* For Magento version 2.0.x to 2.1.x \- php bin/magento setup:static-content:deploy  
* For Magento version 2.2.x & above \- php bin/magento setup:static-content:deploy –f  
* php bin/magento cache:flush

## **How to Configure Magento 2 Multiple Flat Rate Shipping**

For configuring the extension, log in to Magento 2, Navigate to **Stores \> Configuration \> Sales \> Shipping Methods \> Multiple Flat Rate Shipping**.

### **Step 1: Enable & Configure Multiple Flat Rate Shipping in the Backend**

![Enable   Configure Multiple Flat Rate Shipping in the Backend](https://github.com/user-attachments/assets/cbc34fcc-3b11-45a4-a64e-8a6ca3cb2c97)

* **Enabled**: Set to **"Yes"** to activate the extension.  
* **Method Name**: Enter a unique name for the shipping method.  
* **Title**: Specify a title to display for the shipping method.  
* **Type**: Choose how the flat rate should be charged (e.g., per order or per item).  
* **Price**: Set the flat rate shipping fee.  
* **Calculate Handling Fee**: Define the method for calculating handling fees.  
* **Handling Fee**: Enter the handling fee amount.  
* **Displayed Error Message**: Provide an error message for cases when the shipping method is unavailable.  
* **Ship to Applicable Countries**: Select either **"All Allowed Countries"** to enable the shipping method globally or specify selected countries.  
* **Ship to Specific Countries**: Choose specific countries where this shipping method will be available.

![Enable   Configure Multiple Flat Rate](https://github.com/user-attachments/assets/a57f7ded-b5e8-4a07-970f-091e879c2ec4)

* **Show Method if Not Applicable:** Select "Yes" to hide the shipping method when it is not applicable.

* **Maximum Order Amount:** Specify the maximum order amount for which this flat rate shipping method will be available.

* **Minimum Order Amount:** Define the minimum order amount required to enable this flat rate shipping option.

* **Show Method Only for Admin:** Set to "Yes" to make the Multiple Flat Rate Shipping method available exclusively for admin users.

* **Sort Order:** Assign a sort order to determine the display position of this method among other shipping options.

### **Step 2: Check For The Multiple Flat Rate Shipping at Frontend**

After configuring multiple flat rates, they will be visible on the frontend. When customers add products to their cart, they can view the available Multiple Flat Rate Shipping options on the cart page. Once a shipping method is selected, it will be applied to the order.

![Check For The Multiple Flat Rate Shipping at Frontend](https://github.com/user-attachments/assets/f178e7ee-1eca-405f-aedf-1214b5960b32)

* **Multiple Flat Rate Shipping on Cart Page**

![Multiple Flat Rate Shipping on Cart Page](https://github.com/user-attachments/assets/de446ae6-dbfe-448a-b6c3-fd011fb2c1f5)

* **Multiple Flat Rate Shipping on the Checkout Page :** The selected Multiple Flat Rate Shipping methods will be applied to the order on the checkout page. Customers can review and confirm their chosen shipping option before completing the purchase.

![Multiple Flat Rate Shipping on the Checkout Page](https://github.com/user-attachments/assets/096019e5-01cf-43d6-912a-6aa456f8a5ce)

* Multiple Flat Rate Shipping in the "My Account" Section : After an order is placed using the Multiple Flat Rate Shipping method, customers can view the shipping details in the "My Orders" tab under their "My Account" section.

### **Step 3: Check For The Multiple Flat Rate Shipping in Admin Order View**

![Check For The Multiple Flat Rate Shipping in Admin Order View](https://github.com/user-attachments/assets/219c2e23-1d61-4664-a68b-518c07fa5ea7)

In addition to the frontend, the details of the Multiple Flat Rate Shipping method can be viewed in the backend under **Sales \> Orders**.

### **Step 4: Save Configuration**

Click **Save Config** to apply changes.

## Download our [Magento 2 Multiple Flat Rate Shipping](https://meetanshi.com/magento-2-multiple-flat-rate-shipping.html) Extension
