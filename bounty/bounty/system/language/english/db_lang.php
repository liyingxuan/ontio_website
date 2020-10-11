<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require ROOTPATH.'config/database.php';
$lang['db_invalid_connection_str'] = 'Unable to determine the database settings based on the connection string you submitted.';
$lang['db_unable_to_connect'] = 'Unable to connect to your database server using the provided settings.';
$lang['db_unable_to_select'] = 'Unable to select the specified database: %s';
$lang['db_unable_to_create'] = 'Unable to create the specified database: %s';
$lang['db_invalid_query'] = 'The query you submitted is not valid.';
$lang['db_must_set_table'] = 'You must set the database table to be used with your query.';
$lang['db_must_use_set'] = 'You must use the "set" method to update an entry.';
$lang['db_must_use_index'] = 'You must specify an index to match on for batch updates.';
$lang['db_batch_missing_index'] = 'One or more rows submitted for batch updating is missing the specified index.';
$lang['db_must_use_where'] = 'Updates are not allowed unless they contain a "where" clause.';
$lang['db_del_must_use_where'] = 'Deletes are not allowed unless they contain a "where" or "like" clause.';
$lang['db_field_param_missing'] = 'To fetch fields requires the name of the table as a parameter.';
$lang['db_unsupported_function'] = 'This feature is not available for the database you are using.';
$lang['db_transaction_failure'] = 'Transaction failure: Rollback performed.';
$lang['db_unable_to_drop'] = 'Unable to drop the specified database.';
$lang['db_unsupported_feature'] = 'Unsupported feature of the database platform you are using.';
$lang['db_unsupported_compression'] = 'The file compression format you chose is not supported by your server.';
$lang['db_filepath_error'] = 'Unable to write data to the file path you have submitted.';
$lang['db_invalid_cache_path'] = 'The cache path you submitted is not valid or writable.';
$lang['db_table_name_required'] = 'A table name is required for that operation.';
$lang['db_column_name_required'] = 'A column name is required for that operation.';
$lang['db_column_definition_required'] = 'A column definition is required for that operation.';
$lang['db_unable_to_set_charset'] = 'Unable to set client connection character set: %s';
$lang['db_error_heading'] = 'A Database Error Occurred';
$prefix = $db['default']['dbprefix'];
$lang['db_filed']['depot_code'] = '仓库';
$lang['db_filed']['brand_code'] = '品牌';
$lang['db_filed']['user_id'] = '用户';
$lang['db_filed']['article_number'] = '货品';
$lang['db_filed']['product_cate_id'] = '货品分类';
$lang['db_filed']['role_id'] = '角色ID';
$lang['db_filed']['rank_code'] = '等级';
$lang['db_filed']['code_id'] = '码段';
$lang['db_filed']['express_code'] = '快递';
$lang['db_filed']['work_cate_id'] = '售后类型';
$lang['db_filed']['asc_id'] = '售后原因';
$lang['db_filed']['refund_cate_id'] = '退款类型';
$lang['db_table']['depot_code'][$prefix.'depot'] = '仓库';
$lang['db_table']['depot_code'][$prefix.'depot_attr_brands'] = '此仓库已给品牌授权,请先取消该仓库下的品牌';
$lang['db_table']['depot_code'][$prefix.'depot_deliver_goods'] = '此仓库已设置发货日期,请先取消该仓库下的发货日期设置';
$lang['db_table']['depot_code'][$prefix.'stocks_amount'] = '此仓库还有货品库存,请先删除该仓库下的库存';
$lang['db_table']['brand_code'][$prefix.'depot_attr_brands'] = '此品牌已给仓库授权,请先取消授权该品牌下的仓库';
$lang['db_table']['brand_code'][$prefix.'stocks'] = '此品牌下还有货品数据,请先删除该品牌下的货品';
$lang['db_table']['user_id'][$prefix.'user_depot_discount_rank'] = '该用户仓库等级折扣已设置,请先删除该用户的仓库等级信息';
$lang['db_table']['user_id'][$prefix.'user_express'] = '该用户仓库配送方式已设置';
$lang['db_table']['user_id'][$prefix.'depot'] = '该用户还有授权的供应仓库,请先取消授权该用户下的仓库';
$lang['db_table']['product_cate_id'][$prefix.'stocks'] = '此分类下还有货品数据，请先删除该分类下的货品';
$lang['db_table']['article_number'][$prefix.'stocks_amount'] = '此货品还有库存，请先删除该货品的库存';
$lang['db_table']['role_id'][$prefix.'user'] = '此角色下还存在用户，请先删除该角色下的用户';
$lang['db_table']['role_id'][$prefix.'admin'] = '此角色下还存在管理员，请先删除该角色下的管理员';
$lang['db_table']['user_id'][$prefix.'mail_log'] = '此用户还有已发邮件信息，请先删除该用户下的邮件';
$lang['db_table']['user_id'][$prefix.'order'] = '此用户还有订单信息，请先删除该用户下的订单';
$lang['db_table']['depot_code'][$prefix.'order'] = '此仓库还有订单信息，请先删除该仓库下的订单';
$lang['db_table']['rank_code'][$prefix.'user_rank_discount'] = '此等级还有代理等级折扣数据，请先删除以此等级设置的代理等级折扣';
$lang['db_table']['rank_code'][$prefix.'user_depot_discount_rank'] = '此等级还有用户仓库等级折扣数据，请先删除以此等级设置的用户仓库等级';
$lang['db_table']['code_id'][$prefix.'stocks'] = '此码段下还有货品数据，请先删除该码段下的所有货品';
$lang['db_table']['express_code'][$prefix.'user_express'] = '此快递还有供应商使用，请先让供应商删除该快递下的配送信息';
$lang['db_table']['work_cate_id'][$prefix.'aftersales_attr'] = '此售后类型下还有订单售后信息，请先删除该售后类型下的售后数据';
$lang['db_table']['asc_id'][$prefix.'aftersales_attr'] = '此售后原因下还有订单售后信息，请先删除该售后原因下的售后数据';
$lang['db_table']['refund_cate_id'][$prefix.'order'] = '此退款类型下还有订单信息，请先删除该退款类型下的订单数据';
$lang['db_table']['agp_id'][$prefix.'store'] = '此区域分组下还有店铺门店，请先取消该分组下的门店';
