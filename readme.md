<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Introduction

this project is a B2C e-commerce project that demonstrates understanding of querying from a RESTful API, building a simple list view, as well as storing data in a local database in a full e-commerce website. 

## Installation

This REST-API built in laravel V 5.6 so make sure your php CLI (command line interface) version is matches version requirements and  local LAMP environment.

- Handle .env file.
- Run the Migrations or You can use my database eapi.sql 
- Register a new user.
- You can use it as a guest but you will be thrown to the login page once you want to submit an Order.
- Now you are good to go.

## Files Functionality

- Controllers/ProductController : used to fetch the products from an endpoint and send it to the view.
- Controllers/OrderController : used to place your orders && view all orders && show details of an order.
- Controllers/Cart : used to handle Cart functionality in terms of Add && Update && Delete.
- Notifications/ChangeStatus : used to send a notification once the status of an order is changed.
- Order, OrderItem : used to handle the orders in the database with Eloquent relationships.
- Views/allProducts : the view for all the products.
- Views/allOrders : displaying all the orders for the authenticated user.
- Views/Cart : the Cart view.
- Views/showOrder : Displaying the details of specific order.
- Routes/Web : used to handle the routes.


## Root Folder

The root folder has
- The application files
- my Mysql database , it's name : eapi.sql

## Conclusion

This task was made using PHP, Laravel and Mysql and it was a really big challenge despite it's not 100% done because the status need to be updated from the endpoint.


