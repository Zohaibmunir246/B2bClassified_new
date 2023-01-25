<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'classes/JsonManipulation.php';

class Categories extends CI_Controller
{
	private static $jsonManipulation = null;

	public function __construct()
	{
		parent::__construct();
		if (!volgo_is_logged_in()) {
			header('Location: ' . base_url('login'));
		}
		$this->load->library('form_validation');
		$this->load->model('Categories_Model');
    $this->load->model('Category_Model');
		if (!self::$jsonManipulation)
			self::$jsonManipulation = new \application\classes\JsonManipulation();
	}

	public function add_old_models()
	{
		echo PHP_EOL . PHP_EOL . ' Already Done ' . PHP_EOL . PHP_EOL;
		exit();

		// REF: https://jsonformatter.org/json-parser
		// Copy from database and get the specific record (extract record) by using above url and then try to add makes into database.


		$data = '[{
    "id": 1,
    "name": "A1 ",
    "slug": "a1",
    "make_id": "1",
    "created_at": "2019-08-05 16:51:43",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 2,
    "name": "A3",
    "slug": "a3",
    "make_id": "1",
    "created_at": "2019-08-05 16:52:00",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 3,
    "name": "A4 ",
    "slug": "a4",
    "make_id": "1",
    "created_at": "2019-08-05 16:53:57",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 4,
    "name": "A5 ",
    "slug": "a5",
    "make_id": "1",
    "created_at": "2019-08-05 16:54:08",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 5,
    "name": "A6 ",
    "slug": "a6",
    "make_id": "1",
    "created_at": "2019-08-05 16:54:25",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 6,
    "name": "A7 ",
    "slug": "a7",
    "make_id": "1",
    "created_at": "2019-08-05 16:56:32",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 7,
    "name": "A8 ",
    "slug": "a8",
    "make_id": "1",
    "created_at": "2019-08-05 16:57:18",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 9,
    "name": "Q3 ",
    "slug": "q3",
    "make_id": "1",
    "created_at": "2019-08-05 16:58:08",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 10,
    "name": "Q5 ",
    "slug": "q5",
    "make_id": "1",
    "created_at": "2019-08-05 16:58:21",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 11,
    "name": "Q7 ",
    "slug": "q7",
    "make_id": "1",
    "created_at": "2019-08-05 16:58:33",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 12,
    "name": "Q8 ",
    "slug": "q8",
    "make_id": "1",
    "created_at": "2019-08-05 16:58:48",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 13,
    "name": "R8 ",
    "slug": "r8",
    "make_id": "1",
    "created_at": "2019-08-05 16:59:00",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 14,
    "name": "S3/RS3 ",
    "slug": "s3-rs3",
    "make_id": "1",
    "created_at": "2019-08-05 16:59:11",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 15,
    "name": "S4/RS4 ‬",
    "slug": "s4-rs4",
    "make_id": "1",
    "created_at": "2019-08-05 16:59:26",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 16,
    "name": "S5/RS5 ‬",
    "slug": "s5-rs5",
    "make_id": "1",
    "created_at": "2019-08-05 16:59:36",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 17,
    "name": "S6/RS6 ",
    "slug": "s6-rs6",
    "make_id": "1",
    "created_at": "2019-08-05 16:59:50",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 18,
    "name": "S7/RS7 ",
    "slug": "s7-rs7",
    "make_id": "1",
    "created_at": "2019-08-05 17:00:03",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 19,
    "name": "S8 ",
    "slug": "s8",
    "make_id": "1",
    "created_at": "2019-08-05 17:00:12",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 20,
    "name": "TT ",
    "slug": "tt-10",
    "make_id": "1",
    "created_at": "2019-08-05 17:00:25",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 21,
    "name": "Other ",
    "slug": "other-13",
    "make_id": "1",
    "created_at": "2019-08-05 17:00:38",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 22,
    "name": "CSX/EL",
    "slug": "csx-el",
    "make_id": "2",
    "created_at": "2019-08-05 17:01:22",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 23,
    "name": "MDX",
    "slug": "mdx",
    "make_id": "2",
    "created_at": "2019-08-05 17:01:32",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 24,
    "name": "NSX",
    "slug": "nsx",
    "make_id": "2",
    "created_at": "2019-08-05 17:01:43",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 25,
    "name": "RDX",
    "slug": "rdx",
    "make_id": "2",
    "created_at": "2019-08-05 17:01:52",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 26,
    "name": "RSX/Integra",
    "slug": "rsx-integra",
    "make_id": "2",
    "created_at": "2019-08-05 17:02:03",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 27,
    "name": "Other",
    "slug": "other-14",
    "make_id": "2",
    "created_at": "2019-08-05 17:02:12",
    "category_id": "5",
    "parent_name": "Acura",
    "sub_category_id": "6"
  },
  {
    "id": 31,
    "name": "2008",
    "slug": "2008",
    "make_id": "4",
    "created_at": "2019-08-05 17:04:26",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 32,
    "name": "206cc",
    "slug": "206cc",
    "make_id": "4",
    "created_at": "2019-08-05 17:04:35",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 33,
    "name": "207",
    "slug": "207",
    "make_id": "4",
    "created_at": "2019-08-05 17:04:45",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 34,
    "name": "207cc",
    "slug": "207cc",
    "make_id": "4",
    "created_at": "2019-08-05 17:04:55",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 35,
    "name": "208",
    "slug": "208",
    "make_id": "4",
    "created_at": "2019-08-05 17:05:08",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 36,
    "name": "3008",
    "slug": "3008",
    "make_id": "1",
    "created_at": "2019-08-05 17:05:18",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 37,
    "name": "301",
    "slug": "301",
    "make_id": "4",
    "created_at": "2019-08-05 17:05:29",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 38,
    "name": "307",
    "slug": "307",
    "make_id": "4",
    "created_at": "2019-08-05 17:05:39",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 39,
    "name": "307cc",
    "slug": "307cc",
    "make_id": "4",
    "created_at": "2019-08-05 17:05:48",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 40,
    "name": "308",
    "slug": "308",
    "make_id": "4",
    "created_at": "2019-08-05 17:05:59",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 41,
    "name": "308cc",
    "slug": "308cc",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:08",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 42,
    "name": "407",
    "slug": "407",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:17",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 43,
    "name": "408",
    "slug": "408",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:26",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 44,
    "name": "5008",
    "slug": "5008",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:37",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 45,
    "name": "504/5",
    "slug": "504-5",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:47",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 46,
    "name": "508",
    "slug": "508",
    "make_id": "4",
    "created_at": "2019-08-05 17:06:56",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 47,
    "name": "607",
    "slug": "607",
    "make_id": "4",
    "created_at": "2019-08-05 17:07:04",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 48,
    "name": "Boxer",
    "slug": "boxer",
    "make_id": "4",
    "created_at": "2019-08-05 17:07:14",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 49,
    "name": "Partner",
    "slug": "partner",
    "make_id": "4",
    "created_at": "2019-08-05 17:07:23",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 50,
    "name": "RC7",
    "slug": "rc7",
    "make_id": "4",
    "created_at": "2019-08-05 17:07:33",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 51,
    "name": "RCZ",
    "slug": "rcz",
    "make_id": "4",
    "created_at": "2019-08-05 17:07:44",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 52,
    "name": "Other",
    "slug": "other-15",
    "make_id": "4",
    "created_at": "2019-08-05 17:08:27",
    "category_id": "5",
    "parent_name": "Peugeot",
    "sub_category_id": "6"
  },
  {
    "id": 53,
    "name": "145/146/147",
    "slug": "145-146-147",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:06",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 54,
    "name": "156/159",
    "slug": "156-159",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:16",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 55,
    "name": "166",
    "slug": "166",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:26",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 56,
    "name": "4C",
    "slug": "4c",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:37",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 57,
    "name": "Brera",
    "slug": "brera",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:48",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 58,
    "name": "GIULIETTA",
    "slug": "giulietta",
    "make_id": "5",
    "created_at": "2019-08-05 17:09:59",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 59,
    "name": "GTV/GT",
    "slug": "gtv-gt",
    "make_id": "5",
    "created_at": "2019-08-05 17:10:08",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 60,
    "name": "Giulia",
    "slug": "giulia",
    "make_id": "5",
    "created_at": "2019-08-05 17:10:18",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 61,
    "name": "Mito",
    "slug": "mito",
    "make_id": "5",
    "created_at": "2019-08-05 17:10:26",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 62,
    "name": "Spider",
    "slug": "spider",
    "make_id": "1",
    "created_at": "2019-08-05 17:10:43",
    "category_id": "5",
    "parent_name": "Audi",
    "sub_category_id": "6"
  },
  {
    "id": 63,
    "name": "Stelvio",
    "slug": "stelvio",
    "make_id": "5",
    "created_at": "2019-08-05 17:10:53",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 64,
    "name": "Other",
    "slug": "other-16",
    "make_id": "5",
    "created_at": "2019-08-05 17:11:03",
    "category_id": "5",
    "parent_name": "Alfa Romeo",
    "sub_category_id": "6"
  },
  {
    "id": 65,
    "name": "Aventador ",
    "slug": "aventador",
    "make_id": "6",
    "created_at": "2019-08-05 17:35:36",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 66,
    "name": "Aventador ",
    "slug": "aventador-2",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:07",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 67,
    "name": "Countach ",
    "slug": "countach",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:16",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 68,
    "name": "Diablo ",
    "slug": "diablo",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:28",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 69,
    "name": "Gallardo ",
    "slug": "gallardo",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:37",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 70,
    "name": "Huracan ",
    "slug": "huracan",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:47",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 71,
    "name": "Murcielago",
    "slug": "murcielago",
    "make_id": "6",
    "created_at": "2019-08-05 17:36:56",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 72,
    "name": "Urus ",
    "slug": "urus",
    "make_id": "6",
    "created_at": "2019-08-05 17:37:09",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 73,
    "name": "Other ",
    "slug": "other-17",
    "make_id": "6",
    "created_at": "2019-08-05 17:37:20",
    "category_id": "5",
    "parent_name": "Lamborghini",
    "sub_category_id": "6"
  },
  {
    "id": 74,
    "name": "Cygnet",
    "slug": "cygnet",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:05",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 75,
    "name": "DB10",
    "slug": "db10",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:17",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 76,
    "name": "DB7",
    "slug": "db7",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:27",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 77,
    "name": "DB9",
    "slug": "db9",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:38",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 78,
    "name": "DBS",
    "slug": "dbs",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:48",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 79,
    "name": "Lagonda",
    "slug": "lagonda",
    "make_id": "7",
    "created_at": "2019-08-05 17:38:57",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 80,
    "name": "One-77",
    "slug": "one-77",
    "make_id": "7",
    "created_at": "2019-08-05 17:39:07",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 81,
    "name": "Rapide",
    "slug": "rapide",
    "make_id": "7",
    "created_at": "2019-08-05 17:39:18",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 82,
    "name": "Vanquish",
    "slug": "vanquish",
    "make_id": "7",
    "created_at": "2019-08-05 17:39:29",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 83,
    "name": "Vantage",
    "slug": "vantage",
    "make_id": "7",
    "created_at": "2019-08-05 17:39:38",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 84,
    "name": "Virage",
    "slug": "virage",
    "make_id": "7",
    "created_at": "2019-08-05 17:39:48",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 85,
    "name": "Vulcan",
    "slug": "vulcan",
    "make_id": "7",
    "created_at": "2019-08-05 17:40:01",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 86,
    "name": "Zagato",
    "slug": "zagato",
    "make_id": "7",
    "created_at": "2019-08-05 17:41:22",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 87,
    "name": "Zagato",
    "slug": "zagato-2",
    "make_id": "7",
    "created_at": "2019-08-05 17:41:29",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 88,
    "name": "Other",
    "slug": "other-18",
    "make_id": "7",
    "created_at": "2019-08-05 17:41:42",
    "category_id": "5",
    "parent_name": "Aston Marti",
    "sub_category_id": "6"
  },
  {
    "id": 89,
    "name": "Avenger",
    "slug": "avenger",
    "make_id": "8",
    "created_at": "2019-08-05 17:44:55",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 90,
    "name": "Caliber ",
    "slug": "caliber",
    "make_id": "8",
    "created_at": "2019-08-05 17:45:50",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 91,
    "name": "Caravan ",
    "slug": "caravan",
    "make_id": "8",
    "created_at": "2019-08-05 17:46:02",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 92,
    "name": "Challenger ",
    "slug": "challenger",
    "make_id": "8",
    "created_at": "2019-08-05 17:46:14",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 93,
    "name": "Charger ",
    "slug": "charger",
    "make_id": "8",
    "created_at": "2019-08-05 17:46:24",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 94,
    "name": "Dart ",
    "slug": "dart",
    "make_id": "8",
    "created_at": "2019-08-05 17:46:33",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 95,
    "name": "Durango ",
    "slug": "durango",
    "make_id": "8",
    "created_at": "2019-08-05 17:46:47",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 96,
    "name": "Journey ‬ ‫",
    "slug": "journey",
    "make_id": "8",
    "created_at": "2019-08-05 17:47:29",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 97,
    "name": "Magnum ",
    "slug": "magnum",
    "make_id": "8",
    "created_at": "2019-08-05 17:47:38",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 98,
    "name": "Neon ",
    "slug": "neon",
    "make_id": "8",
    "created_at": "2019-08-05 17:47:47",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 99,
    "name": "Nitro ",
    "slug": "nitro",
    "make_id": "8",
    "created_at": "2019-08-05 17:47:57",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 100,
    "name": "Pickup ",
    "slug": "pickup",
    "make_id": "8",
    "created_at": "2019-08-05 17:48:06",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 101,
    "name": "Ram ",
    "slug": "ram-3",
    "make_id": "8",
    "created_at": "2019-08-05 17:48:15",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 102,
    "name": "Viper ",
    "slug": "viper",
    "make_id": "8",
    "created_at": "2019-08-05 17:48:24",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 103,
    "name": "Other ",
    "slug": "other-19",
    "make_id": "8",
    "created_at": "2019-08-05 17:49:00",
    "category_id": "5",
    "parent_name": "Dodge",
    "sub_category_id": "6"
  },
  {
    "id": 104,
    "name": "Defender",
    "slug": "defender",
    "make_id": "9",
    "created_at": "2019-08-05 17:49:45",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 105,
    "name": "Discovery",
    "slug": "discovery",
    "make_id": "9",
    "created_at": "2019-08-05 17:49:57",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 106,
    "name": "Discovery Sport",
    "slug": "discovery-sport",
    "make_id": "9",
    "created_at": "2019-08-05 17:50:09",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 107,
    "name": "Evoque",
    "slug": "evoque",
    "make_id": "9",
    "created_at": "2019-08-05 17:50:21",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 108,
    "name": "Freelander",
    "slug": "freelander",
    "make_id": "9",
    "created_at": "2019-08-05 17:50:33",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 109,
    "name": "HSE V8",
    "slug": "hse-v8",
    "make_id": "9",
    "created_at": "2019-08-05 17:50:44",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 110,
    "name": "LR2",
    "slug": "lr2",
    "make_id": "9",
    "created_at": "2019-08-05 17:50:52",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 111,
    "name": "LR3",
    "slug": "lr3",
    "make_id": "9",
    "created_at": "2019-08-05 17:51:02",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 112,
    "name": "LR4",
    "slug": "lr4",
    "make_id": "9",
    "created_at": "2019-08-05 17:51:11",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 113,
    "name": "Range Rover",
    "slug": "range-rover",
    "make_id": "9",
    "created_at": "2019-08-05 17:51:21",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 114,
    "name": "Range Rover Sport",
    "slug": "range-rover-sport",
    "make_id": "9",
    "created_at": "2019-08-05 17:51:31",
    "category_id": "5",
    "parent_name": "Land Rover",
    "sub_category_id": "6"
  },
  {
    "id": 115,
    "name": "918 Spyder",
    "slug": "918-spyder",
    "make_id": "10",
    "created_at": "2019-08-05 17:52:41",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 116,
    "name": "944 ",
    "slug": "944",
    "make_id": "10",
    "created_at": "2019-08-05 17:52:51",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 117,
    "name": "968 ",
    "slug": "968",
    "make_id": "10",
    "created_at": "2019-08-05 17:53:01",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 118,
    "name": "Boxster ",
    "slug": "boxster",
    "make_id": "10",
    "created_at": "2019-08-05 17:53:10",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 119,
    "name": "Carrera / 911 ",
    "slug": "carrera-911",
    "make_id": "10",
    "created_at": "2019-08-05 17:53:23",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 120,
    "name": "Cayenne ",
    "slug": "cayenne",
    "make_id": "10",
    "created_at": "2019-08-05 17:53:33",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 121,
    "name": "Cayman ",
    "slug": "cayman",
    "make_id": "10",
    "created_at": "2019-08-05 17:53:46",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 122,
    "name": "Macan ",
    "slug": "macan",
    "make_id": "10",
    "created_at": "2019-08-05 17:57:21",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 123,
    "name": "Panamera ",
    "slug": "panamera",
    "make_id": "10",
    "created_at": "2019-08-05 17:57:58",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 124,
    "name": "Other ",
    "slug": "other-20",
    "make_id": "10",
    "created_at": "2019-08-05 17:58:09",
    "category_id": "5",
    "parent_name": "Porsche",
    "sub_category_id": "6"
  },
  {
    "id": 125,
    "name": "355 ",
    "slug": "355",
    "make_id": "11",
    "created_at": "2019-08-05 17:58:34",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 126,
    "name": "360 ",
    "slug": "360",
    "make_id": "11",
    "created_at": "2019-08-05 17:58:42",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 127,
    "name": "458 ",
    "slug": "458",
    "make_id": "11",
    "created_at": "2019-08-05 17:58:51",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 128,
    "name": "458 Italia ‬ ‫",
    "slug": "458-italia",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:01",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 129,
    "name": "458 Speciale ",
    "slug": "458-speciale",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:10",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 130,
    "name": "458 Spider",
    "slug": "458-spider",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:20",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 131,
    "name": "488 ",
    "slug": "488",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:28",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 132,
    "name": "488 GTB ‬ ‫",
    "slug": "488-gtb",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:38",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 133,
    "name": "488 Spider ",
    "slug": "488-spider",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:47",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 134,
    "name": "512 ",
    "slug": "512",
    "make_id": "11",
    "created_at": "2019-08-05 17:59:55",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 135,
    "name": "599 ",
    "slug": "599",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:04",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 136,
    "name": "599 GTB ‬ ‫",
    "slug": "599-gtb",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:13",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 137,
    "name": "812 Superfast",
    "slug": "812-superfast",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:22",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 138,
    "name": "California ‬ ‫",
    "slug": "california",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:30",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 139,
    "name": "California T ‬ ‫",
    "slug": "california-t",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:40",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 140,
    "name": "F12 ",
    "slug": "f12",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:49",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 141,
    "name": "F430 ",
    "slug": "f430",
    "make_id": "11",
    "created_at": "2019-08-05 18:00:57",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 142,
    "name": "F430 Spider",
    "slug": "f430-spider",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:07",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 143,
    "name": "FF ",
    "slug": "ff-9",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:14",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 144,
    "name": "Ferrari 456 ‬ ",
    "slug": "ferrari-456",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:22",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 145,
    "name": "GTC4 Lusso ",
    "slug": "gtc4-lusso",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:32",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 146,
    "name": "LaFerrari ",
    "slug": "laferrari",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:41",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 147,
    "name": "Scaglietti ",
    "slug": "scaglietti",
    "make_id": "11",
    "created_at": "2019-08-05 18:01:50",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 148,
    "name": "Super America",
    "slug": "super-america",
    "make_id": "11",
    "created_at": "2019-08-05 18:03:05",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 149,
    "name": "Other ",
    "slug": "other-21",
    "make_id": "11",
    "created_at": "2019-08-05 18:03:15",
    "category_id": "5",
    "parent_name": "Ferrari",
    "sub_category_id": "6"
  },
  {
    "id": 150,
    "name": "ES-Series ",
    "slug": "es-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:03:42",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 151,
    "name": "GS-Series",
    "slug": "gs-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:03:54",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 152,
    "name": "GX-Series",
    "slug": "gx-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:04:04",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 153,
    "name": "IS-C ‬ ",
    "slug": "is-c",
    "make_id": "12",
    "created_at": "2019-08-05 18:04:13",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 154,
    "name": "IS-F ",
    "slug": "is-f",
    "make_id": "12",
    "created_at": "2019-08-05 18:04:31",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 155,
    "name": "IS-Series",
    "slug": "is-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:04:52",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 156,
    "name": "LC 500 ",
    "slug": "lc-500",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:00",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 157,
    "name": "LFA ",
    "slug": "lfa-2",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:08",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 158,
    "name": "LS-Series ",
    "slug": "ls-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:17",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 159,
    "name": "LX-Series ",
    "slug": "lx-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:25",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 160,
    "name": "NX 200t",
    "slug": "nx-200t",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:33",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 161,
    "name": "NX 300 ",
    "slug": "nx-300",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:42",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 162,
    "name": "RC ",
    "slug": "rc-17",
    "make_id": "12",
    "created_at": "2019-08-05 18:05:51",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 163,
    "name": "RC F",
    "slug": "rc-f",
    "make_id": "12",
    "created_at": "2019-08-05 18:06:04",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 164,
    "name": "RX-Series ",
    "slug": "rx-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:06:18",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 165,
    "name": "RX-Series ",
    "slug": "rx-series-2",
    "make_id": "12",
    "created_at": "2019-08-05 18:06:22",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 166,
    "name": "SC-Series ",
    "slug": "sc-series",
    "make_id": "12",
    "created_at": "2019-08-05 18:06:44",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 167,
    "name": "Other ",
    "slug": "other-22",
    "make_id": "12",
    "created_at": "2019-08-05 18:06:54",
    "category_id": "5",
    "parent_name": "Lexus",
    "sub_category_id": "6"
  },
  {
    "id": 168,
    "name": "A1",
    "slug": "a1-2",
    "make_id": "13",
    "created_at": "2019-08-05 18:07:28",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 169,
    "name": "A113",
    "slug": "a113",
    "make_id": "13",
    "created_at": "2019-08-05 18:07:36",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 170,
    "name": "A115",
    "slug": "a115",
    "make_id": "13",
    "created_at": "2019-08-05 18:07:46",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 171,
    "name": "A523",
    "slug": "a523",
    "make_id": "13",
    "created_at": "2019-08-05 18:07:56",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 172,
    "name": "MZ40",
    "slug": "mz40",
    "make_id": "13",
    "created_at": "2019-08-05 18:08:07",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 173,
    "name": "MZ45",
    "slug": "mz45",
    "make_id": "13",
    "created_at": "2019-08-05 18:08:14",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 174,
    "name": "X424",
    "slug": "x424",
    "make_id": "13",
    "created_at": "2019-08-05 18:08:23",
    "category_id": "5",
    "parent_name": "BAIC",
    "sub_category_id": "6"
  },
  {
    "id": 175,
    "name": "500X",
    "slug": "500x",
    "make_id": "14",
    "created_at": "2019-08-05 18:08:50",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 176,
    "name": "Barchetta",
    "slug": "barchetta",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:00",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 177,
    "name": "Brava",
    "slug": "brava",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:08",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 178,
    "name": "Fiat-500",
    "slug": "fiat-500",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:16",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 179,
    "name": "Linea",
    "slug": "linea",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:24",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 180,
    "name": "Marea",
    "slug": "marea",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:32",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 181,
    "name": "Punto",
    "slug": "punto",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:41",
    "category_id": "5",
    "parent_name": "Fiat",
    "sub_category_id": "6"
  },
  {
    "id": 182,
    "name": "Sienna",
    "slug": "sienna",
    "make_id": "14",
    "created_at": "2019-08-05 18:09:55",
    "category_id": "5",
    "sub_category_id": "6",
    "parent_name": "Fiat"
  },
  {
    "id": 183,
    "name": "Tempra",
    "slug": "tempra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "14",
    "created_at": "2019-08-06 15:58:18",
    "parent_name": "Fiat"
  },
  {
    "id": 184,
    "name": "Uno",
    "slug": "uno",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "14",
    "created_at": "2019-08-06 15:58:27",
    "parent_name": "Fiat"
  },
  {
    "id": 185,
    "name": "Other",
    "slug": "other-23",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "14",
    "created_at": "2019-08-06 15:58:37",
    "parent_name": "Fiat"
  },
  {
    "id": 186,
    "name": "Continental",
    "slug": "continental",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 15:59:07",
    "parent_name": "Lincoln "
  },
  {
    "id": 187,
    "name": "LS ",
    "slug": "ls-16",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 15:59:16",
    "parent_name": "Lincoln "
  },
  {
    "id": 188,
    "name": "MKC ",
    "slug": "mkc",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 15:59:25",
    "parent_name": "Lincoln "
  },
  {
    "id": 189,
    "name": "MKS ",
    "slug": "mks",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 15:59:33",
    "parent_name": "Lincoln "
  },
  {
    "id": 190,
    "name": "MKT ",
    "slug": "mkt",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 15:59:40",
    "parent_name": "Lincoln "
  },
  {
    "id": 191,
    "name": "MKX ",
    "slug": "mkx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 16:00:24",
    "parent_name": "Lincoln "
  },
  {
    "id": 192,
    "name": "MKZ ",
    "slug": "mkz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 16:00:31",
    "parent_name": "Lincoln "
  },
  {
    "id": 193,
    "name": "Navigator",
    "slug": "navigator",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 16:00:39",
    "parent_name": "Lincoln "
  },
  {
    "id": 194,
    "name": "Town Car ",
    "slug": "town-car",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 16:00:49",
    "parent_name": "Lincoln "
  },
  {
    "id": 195,
    "name": "Other ",
    "slug": "other-24",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "15",
    "created_at": "2019-08-06 16:00:57",
    "parent_name": "Lincoln "
  },
  {
    "id": 196,
    "name": "Captur ",
    "slug": "captur",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:01:31",
    "parent_name": "Renault"
  },
  {
    "id": 197,
    "name": "Captur ",
    "slug": "captur-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:02:08",
    "parent_name": "Renault"
  },
  {
    "id": 198,
    "name": "Clio ",
    "slug": "clio",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:02:17",
    "parent_name": "Renault"
  },
  {
    "id": 199,
    "name": "Dokker ",
    "slug": "dokker",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:02:25",
    "parent_name": "Renault"
  },
  {
    "id": 200,
    "name": "Duster ",
    "slug": "duster",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:02:32",
    "parent_name": "Renault"
  },
  {
    "id": 201,
    "name": "Fluence",
    "slug": "fluence",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:12",
    "parent_name": "Renault"
  },
  {
    "id": 202,
    "name": "Koleos ",
    "slug": "koleos",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:21",
    "parent_name": "Renault"
  },
  {
    "id": 203,
    "name": "Logan ",
    "slug": "logan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:30",
    "parent_name": "Renault"
  },
  {
    "id": 204,
    "name": "Megane ",
    "slug": "megane",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:40",
    "parent_name": "Renault"
  },
  {
    "id": 205,
    "name": "Safrane ",
    "slug": "safrane",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:47",
    "parent_name": "Renault"
  },
  {
    "id": 206,
    "name": "Sandero ",
    "slug": "sandero",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:03:57",
    "parent_name": "Renault"
  },
  {
    "id": 207,
    "name": "Symbol ",
    "slug": "symbol",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:04:10",
    "parent_name": "Renault"
  },
  {
    "id": 208,
    "name": "Trafic ",
    "slug": "trafic",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:04:18",
    "parent_name": "Renault"
  },
  {
    "id": 209,
    "name": "Twizy ",
    "slug": "twizy",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:04:26",
    "parent_name": "Renault"
  },
  {
    "id": 210,
    "name": "Other ",
    "slug": "other-25",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "16",
    "created_at": "2019-08-06 16:04:38",
    "parent_name": "Renault"
  },
  {
    "id": 211,
    "name": "1-Series ‬ ‫",
    "slug": "1-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:05:10",
    "parent_name": "BMW"
  },
  {
    "id": 212,
    "name": "2-Series ",
    "slug": "2-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:05:23",
    "parent_name": "BMW"
  },
  {
    "id": 213,
    "name": "3-Series ",
    "slug": "3-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:05:36",
    "parent_name": "BMW"
  },
  {
    "id": 214,
    "name": "4-Series",
    "slug": "4-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:05:46",
    "parent_name": "BMW"
  },
  {
    "id": 215,
    "name": "5-Series",
    "slug": "5-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:06:01",
    "parent_name": "BMW"
  },
  {
    "id": 216,
    "name": "6-Series ",
    "slug": "6-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:06:13",
    "parent_name": "BMW"
  },
  {
    "id": 217,
    "name": "7-Series ‬ ‫",
    "slug": "7-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:06:21",
    "parent_name": "BMW"
  },
  {
    "id": 218,
    "name": "8-Series ‬ ‫",
    "slug": "8-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:06:49",
    "parent_name": "BMW"
  },
  {
    "id": 219,
    "name": "M-Coupe ",
    "slug": "m-coupe",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:06:58",
    "parent_name": "BMW"
  },
  {
    "id": 220,
    "name": "M2",
    "slug": "m2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:07",
    "parent_name": "BMW"
  },
  {
    "id": 221,
    "name": "M3",
    "slug": "m3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:18",
    "parent_name": "BMW"
  },
  {
    "id": 222,
    "name": "M4",
    "slug": "m4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:26",
    "parent_name": "BMW"
  },
  {
    "id": 223,
    "name": "M5 ",
    "slug": "m5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:36",
    "parent_name": "BMW"
  },
  {
    "id": 224,
    "name": "M6 ",
    "slug": "m6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:44",
    "parent_name": "BMW"
  },
  {
    "id": 225,
    "name": "X1 ",
    "slug": "x1",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:07:52",
    "parent_name": "BMW"
  },
  {
    "id": 226,
    "name": "X2 ",
    "slug": "x2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:01",
    "parent_name": "BMW"
  },
  {
    "id": 227,
    "name": "X3 ",
    "slug": "x3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:09",
    "parent_name": "BMW"
  },
  {
    "id": 228,
    "name": "X4 ",
    "slug": "x4-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:18",
    "parent_name": "BMW"
  },
  {
    "id": 229,
    "name": "X5 ",
    "slug": "x5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:26",
    "parent_name": "BMW"
  },
  {
    "id": 230,
    "name": "X6 ",
    "slug": "x6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:34",
    "parent_name": "BMW"
  },
  {
    "id": 231,
    "name": "Z3 ",
    "slug": "z3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:43",
    "parent_name": "BMW"
  },
  {
    "id": 232,
    "name": "Z4 ",
    "slug": "z4-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:08:51",
    "parent_name": "BMW"
  },
  {
    "id": 233,
    "name": "Z8 ",
    "slug": "z8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:09:00",
    "parent_name": "BMW"
  },
  {
    "id": 234,
    "name": "i8 ",
    "slug": "i8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:09:08",
    "parent_name": "BMW"
  },
  {
    "id": 235,
    "name": "Other ",
    "slug": "other-26",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "17",
    "created_at": "2019-08-06 16:09:16",
    "parent_name": "BMW"
  },
  {
    "id": 236,
    "name": "Karma ",
    "slug": "karma",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "18",
    "created_at": "2019-08-06 16:09:40",
    "parent_name": "Fisker"
  },
  {
    "id": 237,
    "name": "Elan",
    "slug": "elan-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:10:15",
    "parent_name": "Lotus"
  },
  {
    "id": 238,
    "name": "Elise",
    "slug": "elise",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:10:23",
    "parent_name": "Lotus"
  },
  {
    "id": 239,
    "name": "Esprit",
    "slug": "esprit",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:10:31",
    "parent_name": "Lotus"
  },
  {
    "id": 240,
    "name": "Evora",
    "slug": "evora",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:10:50",
    "parent_name": "Lotus"
  },
  {
    "id": 241,
    "name": "Exige",
    "slug": "exige",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:11:00",
    "parent_name": "Lotus"
  },
  {
    "id": 242,
    "name": "Other",
    "slug": "other-27",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "19",
    "created_at": "2019-08-06 16:11:07",
    "parent_name": "Lotus"
  },
  {
    "id": 243,
    "name": "Dawn",
    "slug": "dawn",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:12:29",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 244,
    "name": "Ghost",
    "slug": "ghost",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:12:40",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 245,
    "name": "Phantom",
    "slug": "phantom",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:12:51",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 246,
    "name": "Silver Seraph",
    "slug": "silver-seraph",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:12:59",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 247,
    "name": "Silver Spur",
    "slug": "silver-spur",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:13:07",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 248,
    "name": "Wraith",
    "slug": "wraith",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:13:15",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 249,
    "name": "Other",
    "slug": "other-28",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "20",
    "created_at": "2019-08-06 16:13:25",
    "parent_name": "Rolls Royce"
  },
  {
    "id": 250,
    "name": "Arnage ",
    "slug": "arnage",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:13:55",
    "parent_name": "Bentley"
  },
  {
    "id": 251,
    "name": "Azure ",
    "slug": "azure",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:14:09",
    "parent_name": "Bentley"
  },
  {
    "id": 252,
    "name": "Bentayga ",
    "slug": "bentayga",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:14:21",
    "parent_name": "Bentley"
  },
  {
    "id": 253,
    "name": "Brooklands ",
    "slug": "brooklands",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:14:31",
    "parent_name": "Bentley"
  },
  {
    "id": 254,
    "name": "Continental ",
    "slug": "continental-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:14:41",
    "parent_name": "Bentley"
  },
  {
    "id": 255,
    "name": "Continental Flying Spur ",
    "slug": "continental-flying-spur",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:14:51",
    "parent_name": "Bentley"
  },
  {
    "id": 256,
    "name": "Continental GT ",
    "slug": "continental-gt",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:15:01",
    "parent_name": "Bentley"
  },
  {
    "id": 257,
    "name": "Mulsanne ",
    "slug": "mulsanne",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:15:11",
    "parent_name": "Bentley"
  },
  {
    "id": 258,
    "name": "Other ",
    "slug": "other-29",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "21",
    "created_at": "2019-08-06 16:15:20",
    "parent_name": "Bentley"
  },
  {
    "id": 259,
    "name": "Aerostar",
    "slug": "aerostar",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:20:59",
    "parent_name": "Ford"
  },
  {
    "id": 260,
    "name": "Aerostar",
    "slug": "aerostar-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:21:20",
    "parent_name": "Ford"
  },
  {
    "id": 261,
    "name": "Bronco",
    "slug": "bronco",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:21:30",
    "parent_name": "Ford"
  },
  {
    "id": 262,
    "name": "Crown Victoria",
    "slug": "crown-victoria",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:21:47",
    "parent_name": "Ford"
  },
  {
    "id": 263,
    "name": "Ecosport",
    "slug": "ecosport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:21:57",
    "parent_name": "Ford"
  },
  {
    "id": 264,
    "name": "Edge",
    "slug": "edge",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:04",
    "parent_name": "Ford"
  },
  {
    "id": 265,
    "name": "Escape",
    "slug": "escape",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:15",
    "parent_name": "Ford"
  },
  {
    "id": 266,
    "name": "Escort",
    "slug": "escort",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:25",
    "parent_name": "Ford"
  },
  {
    "id": 267,
    "name": "Excursion",
    "slug": "excursion",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:33",
    "parent_name": "Ford"
  },
  {
    "id": 268,
    "name": "Expedition",
    "slug": "expedition",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:44",
    "parent_name": "Ford"
  },
  {
    "id": 269,
    "name": "Explorer",
    "slug": "explorer",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:22:57",
    "parent_name": "Ford"
  },
  {
    "id": 270,
    "name": "F-Series Pickup",
    "slug": "f-series-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:07",
    "parent_name": "Ford"
  },
  {
    "id": 271,
    "name": "Fiesta",
    "slug": "fiesta",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:15",
    "parent_name": "Ford"
  },
  {
    "id": 272,
    "name": "Figo",
    "slug": "figo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:25",
    "parent_name": "Ford"
  },
  {
    "id": 273,
    "name": "Five Hundred",
    "slug": "five-hundred",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:33",
    "parent_name": "Ford"
  },
  {
    "id": 274,
    "name": "Flex",
    "slug": "flex",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:43",
    "parent_name": "Ford"
  },
  {
    "id": 275,
    "name": "Focus",
    "slug": "focus",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:23:51",
    "parent_name": "Ford"
  },
  {
    "id": 276,
    "name": "Fusion",
    "slug": "fusion",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:24:23",
    "parent_name": "Ford"
  },
  {
    "id": 277,
    "name": "GT",
    "slug": "gt-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:24:32",
    "parent_name": "Ford"
  },
  {
    "id": 278,
    "name": "Mondeo",
    "slug": "mondeo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:24:41",
    "parent_name": "Ford"
  },
  {
    "id": 279,
    "name": "Mondeo",
    "slug": "mondeo-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:08",
    "parent_name": "Ford"
  },
  {
    "id": 280,
    "name": "Mustang",
    "slug": "mustang",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:17",
    "parent_name": "Ford"
  },
  {
    "id": 281,
    "name": "Pickup",
    "slug": "pickup-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:26",
    "parent_name": "Ford"
  },
  {
    "id": 282,
    "name": "Ranger",
    "slug": "ranger",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:38",
    "parent_name": "Ford"
  },
  {
    "id": 283,
    "name": "Taurus",
    "slug": "taurus",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:47",
    "parent_name": "Ford"
  },
  {
    "id": 284,
    "name": "Thunderbird",
    "slug": "thunderbird",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:25:56",
    "parent_name": "Ford"
  },
  {
    "id": 285,
    "name": "Van",
    "slug": "van-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:26:50",
    "parent_name": "Ford"
  },
  {
    "id": 286,
    "name": "Other",
    "slug": "other-30",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "22",
    "created_at": "2019-08-06 16:26:59",
    "parent_name": "Ford"
  },
  {
    "id": 287,
    "name": "7 MPV",
    "slug": "7-mpv",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:28:14",
    "parent_name": "Luxgen"
  },
  {
    "id": 288,
    "name": "7 SUV",
    "slug": "7-suv",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:28:26",
    "parent_name": "Luxgen"
  },
  {
    "id": 289,
    "name": "S5",
    "slug": "s5-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:28:37",
    "parent_name": "Luxgen"
  },
  {
    "id": 290,
    "name": "U6",
    "slug": "u6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:28:46",
    "parent_name": "Luxgen"
  },
  {
    "id": 291,
    "name": "U7 Turbo",
    "slug": "u7-turbo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:28:55",
    "parent_name": "Luxgen"
  },
  {
    "id": 292,
    "name": "Other",
    "slug": "other-31",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "23",
    "created_at": "2019-08-06 16:29:04",
    "parent_name": "Luxgen"
  },
  {
    "id": 293,
    "name": "75",
    "slug": "75",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "24",
    "created_at": "2019-08-06 16:29:33",
    "parent_name": "Rover"
  },
  {
    "id": 294,
    "name": "BX5 ",
    "slug": "bx5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "25",
    "created_at": "2019-08-06 16:31:49",
    "parent_name": "Borgward"
  },
  {
    "id": 295,
    "name": "BX7 ",
    "slug": "bx7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "25",
    "created_at": "2019-08-06 16:31:58",
    "parent_name": "Borgward"
  },
  {
    "id": 296,
    "name": "Acadia",
    "slug": "acadia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:32:25",
    "parent_name": "GMC"
  },
  {
    "id": 297,
    "name": "Canyon",
    "slug": "canyon",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:32:43",
    "parent_name": "GMC"
  },
  {
    "id": 298,
    "name": "Envoy",
    "slug": "envoy",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:32:54",
    "parent_name": "GMC"
  },
  {
    "id": 299,
    "name": "Jimmy",
    "slug": "jimmy",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:02",
    "parent_name": "GMC"
  },
  {
    "id": 300,
    "name": "Pickup",
    "slug": "pickup-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:15",
    "parent_name": "GMC"
  },
  {
    "id": 301,
    "name": "Savana",
    "slug": "savana",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:25",
    "parent_name": "GMC"
  },
  {
    "id": 302,
    "name": "Sierra",
    "slug": "sierra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:35",
    "parent_name": "GMC"
  },
  {
    "id": 303,
    "name": "Suburban",
    "slug": "suburban",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:44",
    "parent_name": "GMC"
  },
  {
    "id": 304,
    "name": "Terrain",
    "slug": "terrain",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:33:55",
    "parent_name": "GMC"
  },
  {
    "id": 305,
    "name": "Yukon",
    "slug": "yukon",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:34:04",
    "parent_name": "GMC"
  },
  {
    "id": 306,
    "name": "Other",
    "slug": "other-32",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "26",
    "created_at": "2019-08-06 16:34:13",
    "parent_name": "GMC"
  },
  {
    "id": 307,
    "name": "GS",
    "slug": "gs-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:34:36",
    "parent_name": "MG"
  },
  {
    "id": 308,
    "name": "MG3",
    "slug": "mg3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:34:44",
    "parent_name": "MG"
  },
  {
    "id": 309,
    "name": "MG350",
    "slug": "mg350",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:34:54",
    "parent_name": "MG"
  },
  {
    "id": 310,
    "name": "MG5",
    "slug": "mg5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:35:10",
    "parent_name": "MG"
  },
  {
    "id": 311,
    "name": "MG550",
    "slug": "mg550",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:35:21",
    "parent_name": "MG"
  },
  {
    "id": 312,
    "name": "MG6",
    "slug": "mg6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:35:30",
    "parent_name": "MG"
  },
  {
    "id": 313,
    "name": "MG750",
    "slug": "mg750",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:37:25",
    "parent_name": "MG"
  },
  {
    "id": 314,
    "name": "RX5",
    "slug": "rx5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:37:34",
    "parent_name": "MG"
  },
  {
    "id": 315,
    "name": "ZS",
    "slug": "zs",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "27",
    "created_at": "2019-08-06 16:37:44",
    "parent_name": "MG"
  },
  {
    "id": 316,
    "name": "9-2x",
    "slug": "9-2x",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:38:23",
    "parent_name": "Saab"
  },
  {
    "id": 317,
    "name": "9-3",
    "slug": "9-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:38:33",
    "parent_name": "Saab"
  },
  {
    "id": 318,
    "name": "9-5",
    "slug": "9-5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:52:20",
    "parent_name": "Saab"
  },
  {
    "id": 319,
    "name": "9-7x",
    "slug": "9-7x",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:52:36",
    "parent_name": "Saab"
  },
  {
    "id": 320,
    "name": "900",
    "slug": "900",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:52:48",
    "parent_name": "Saab"
  },
  {
    "id": 321,
    "name": "9000",
    "slug": "9000",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:52:56",
    "parent_name": "Saab"
  },
  {
    "id": 322,
    "name": "Other",
    "slug": "other-33",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "28",
    "created_at": "2019-08-06 16:53:07",
    "parent_name": "Saab"
  },
  {
    "id": 323,
    "name": "H530",
    "slug": "h530",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "29",
    "created_at": "2019-08-06 16:55:26",
    "parent_name": "Brilliance"
  },
  {
    "id": 324,
    "name": "V5",
    "slug": "v5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "29",
    "created_at": "2019-08-06 16:55:37",
    "parent_name": "Brilliance"
  },
  {
    "id": 325,
    "name": "Emgrand 7",
    "slug": "emgrand-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:56:01",
    "parent_name": "Geely"
  },
  {
    "id": 326,
    "name": "Emgrand 8",
    "slug": "emgrand-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:56:13",
    "parent_name": "Geely"
  },
  {
    "id": 327,
    "name": "Emgrand GS Sport",
    "slug": "emgrand-gs-sport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:56:22",
    "parent_name": "Geely"
  },
  {
    "id": 328,
    "name": "Emgrand GT",
    "slug": "emgrand-gt",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:56:31",
    "parent_name": "Geely"
  },
  {
    "id": 329,
    "name": "Emgrand GT V6",
    "slug": "emgrand-gt-v6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:56:40",
    "parent_name": "Geely"
  },
  {
    "id": 330,
    "name": "Emgrand X7",
    "slug": "emgrand-x7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:57:12",
    "parent_name": "Geely"
  },
  {
    "id": 331,
    "name": "Emgrand X7 Sport",
    "slug": "emgrand-x7-sport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:58:19",
    "parent_name": "Geely"
  },
  {
    "id": 332,
    "name": "GC2",
    "slug": "gc2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:58:29",
    "parent_name": "Geely"
  },
  {
    "id": 333,
    "name": "GC6",
    "slug": "gc6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 16:59:55",
    "parent_name": "Geely"
  },
  {
    "id": 334,
    "name": "GX2",
    "slug": "gx2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "30",
    "created_at": "2019-08-06 17:00:03",
    "parent_name": "Geely"
  },
  {
    "id": 335,
    "name": "Clubman ",
    "slug": "clubman",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:01:44",
    "parent_name": "MINI"
  },
  {
    "id": 336,
    "name": "Cooper ",
    "slug": "cooper",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:02:06",
    "parent_name": "MINI"
  },
  {
    "id": 337,
    "name": "Countryman ",
    "slug": "countryman",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:02:23",
    "parent_name": "MINI"
  },
  {
    "id": 338,
    "name": "Coupe ",
    "slug": "coupe-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:02:33",
    "parent_name": "MINI"
  },
  {
    "id": 339,
    "name": "Paceman ",
    "slug": "paceman",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:02:53",
    "parent_name": "MINI"
  },
  {
    "id": 340,
    "name": "Roadster ",
    "slug": "roadster",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:03:09",
    "parent_name": "MINI"
  },
  {
    "id": 341,
    "name": "Other ",
    "slug": "other-34",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "31",
    "created_at": "2019-08-06 17:03:19",
    "parent_name": "MINI"
  },
  {
    "id": 342,
    "name": "Alhambra",
    "slug": "alhambra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-06 17:03:45",
    "parent_name": "Seat"
  },
  {
    "id": 343,
    "name": "Altea",
    "slug": "altea",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:42:30",
    "parent_name": "Seat"
  },
  {
    "id": 344,
    "name": "Cordoba",
    "slug": "cordoba",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:42:42",
    "parent_name": "Seat"
  },
  {
    "id": 345,
    "name": "Exeo",
    "slug": "exeo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:42:52",
    "parent_name": "Seat"
  },
  {
    "id": 346,
    "name": "Ibiza",
    "slug": "ibiza",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:43:01",
    "parent_name": "Seat"
  },
  {
    "id": 347,
    "name": "Leon",
    "slug": "leon",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:43:12",
    "parent_name": "Seat"
  },
  {
    "id": 348,
    "name": "Toledo",
    "slug": "toledo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:43:21",
    "parent_name": "Seat"
  },
  {
    "id": 349,
    "name": "Other",
    "slug": "other-35",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "32",
    "created_at": "2019-08-07 14:43:30",
    "parent_name": "Seat"
  },
  {
    "id": 350,
    "name": "Apollo ",
    "slug": "apollo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "33",
    "created_at": "2019-08-07 14:45:02",
    "parent_name": "Gumpert"
  },
  {
    "id": 351,
    "name": "Scorpio Pickup ",
    "slug": "scorpio-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "34",
    "created_at": "2019-08-07 14:46:14",
    "parent_name": "Mahindra"
  },
  {
    "id": 352,
    "name": "XUV5000",
    "slug": "xuv5000",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "34",
    "created_at": "2019-08-07 14:46:26",
    "parent_name": "Mahindra"
  },
  {
    "id": 353,
    "name": "Chiron",
    "slug": "chiron",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:08",
    "parent_name": "Bugatti"
  },
  {
    "id": 354,
    "name": "Grand Sport",
    "slug": "grand-sport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:20",
    "parent_name": "Bugatti"
  },
  {
    "id": 355,
    "name": "Grand Sport Vitesse",
    "slug": "grand-sport-vitesse",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:30",
    "parent_name": "Bugatti"
  },
  {
    "id": 356,
    "name": "Super Sport",
    "slug": "super-sport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:40",
    "parent_name": "Bugatti"
  },
  {
    "id": 357,
    "name": "Veyron",
    "slug": "veyron",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:49",
    "parent_name": "Bugatti"
  },
  {
    "id": 358,
    "name": "Veyron 16.4",
    "slug": "veyron-16-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:47:59",
    "parent_name": "Bugatti"
  },
  {
    "id": 359,
    "name": "Other",
    "slug": "other-36",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "35",
    "created_at": "2019-08-07 14:48:10",
    "parent_name": "Bugatti"
  },
  {
    "id": 360,
    "name": "Accord",
    "slug": "accord",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:48:40",
    "parent_name": "Honda"
  },
  {
    "id": 361,
    "name": "City",
    "slug": "city",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:48:50",
    "parent_name": "Honda"
  },
  {
    "id": 362,
    "name": "Civic",
    "slug": "civic",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:49:00",
    "parent_name": "Honda"
  },
  {
    "id": 363,
    "name": "Crosstour",
    "slug": "crosstour",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:49:38",
    "parent_name": "Honda"
  },
  {
    "id": 364,
    "name": "Element",
    "slug": "element",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:49:48",
    "parent_name": "Honda"
  },
  {
    "id": 365,
    "name": "Fit",
    "slug": "fit-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:50:00",
    "parent_name": "Honda"
  },
  {
    "id": 366,
    "name": "HR-V",
    "slug": "hr-v",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:50:10",
    "parent_name": "Honda"
  },
  {
    "id": 367,
    "name": "Jazz",
    "slug": "jazz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:50:57",
    "parent_name": "Honda"
  },
  {
    "id": 368,
    "name": "Legend",
    "slug": "legend",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:51:07",
    "parent_name": "Honda"
  },
  {
    "id": 369,
    "name": "MR-V",
    "slug": "mr-v",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:11",
    "parent_name": "Honda"
  },
  {
    "id": 370,
    "name": "Odyssey",
    "slug": "odyssey",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:20",
    "parent_name": "Honda"
  },
  {
    "id": 371,
    "name": "Pickup",
    "slug": "pickup-6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:30",
    "parent_name": "Honda"
  },
  {
    "id": 372,
    "name": "Pilot",
    "slug": "pilot",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:38",
    "parent_name": "Honda"
  },
  {
    "id": 373,
    "name": "Prelude",
    "slug": "prelude",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:47",
    "parent_name": "Honda"
  },
  {
    "id": 374,
    "name": "S2000",
    "slug": "s2000",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:52:56",
    "parent_name": "Honda"
  },
  {
    "id": 375,
    "name": "Van",
    "slug": "van-6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "36",
    "created_at": "2019-08-07 14:53:07",
    "parent_name": "Honda"
  },
  {
    "id": 376,
    "name": "4200",
    "slug": "4200",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:55:25",
    "parent_name": "Maserati"
  },
  {
    "id": 377,
    "name": "Ghibli",
    "slug": "ghibli",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:03",
    "parent_name": "Maserati"
  },
  {
    "id": 378,
    "name": "GranCabrio",
    "slug": "grancabrio",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:15",
    "parent_name": "Maserati"
  },
  {
    "id": 379,
    "name": "GranSport",
    "slug": "gransport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:24",
    "parent_name": "Maserati"
  },
  {
    "id": 380,
    "name": "GranTurismo",
    "slug": "granturismo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:33",
    "parent_name": "Maserati"
  },
  {
    "id": 381,
    "name": "Levante",
    "slug": "levante",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:42",
    "parent_name": "Maserati"
  },
  {
    "id": 382,
    "name": "MC12",
    "slug": "mc12",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:58:52",
    "parent_name": "Maserati"
  },
  {
    "id": 383,
    "name": "Quattroporte",
    "slug": "quattroporte",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:59:02",
    "parent_name": "Maserati"
  },
  {
    "id": 384,
    "name": "Spyder",
    "slug": "spyder-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:59:12",
    "parent_name": "Maserati"
  },
  {
    "id": 385,
    "name": "Other",
    "slug": "other-37",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "37",
    "created_at": "2019-08-07 14:59:22",
    "parent_name": "Maserati"
  },
  {
    "id": 386,
    "name": "Fabia",
    "slug": "fabia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "38",
    "created_at": "2019-08-07 15:00:25",
    "parent_name": "Skoda"
  },
  {
    "id": 387,
    "name": "Octavia",
    "slug": "octavia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "38",
    "created_at": "2019-08-07 15:00:35",
    "parent_name": "Skoda"
  },
  {
    "id": 388,
    "name": "Superb",
    "slug": "superb",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "38",
    "created_at": "2019-08-07 15:00:44",
    "parent_name": "Skoda"
  },
  {
    "id": 389,
    "name": "Other",
    "slug": "other-38",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "38",
    "created_at": "2019-08-07 15:00:53",
    "parent_name": "Skoda"
  },
  {
    "id": 390,
    "name": "H1 ",
    "slug": "h1",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "39",
    "created_at": "2019-08-07 15:01:22",
    "parent_name": "Hummer"
  },
  {
    "id": 391,
    "name": "H2 ",
    "slug": "h2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "39",
    "created_at": "2019-08-07 15:01:32",
    "parent_name": "Hummer"
  },
  {
    "id": 392,
    "name": "H3 ",
    "slug": "h3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "39",
    "created_at": "2019-08-07 15:01:54",
    "parent_name": "Hummer"
  },
  {
    "id": 393,
    "name": "H3T",
    "slug": "h3t",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "39",
    "created_at": "2019-08-07 15:02:05",
    "parent_name": "Hummer"
  },
  {
    "id": 394,
    "name": "HX",
    "slug": "hx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "39",
    "created_at": "2019-08-07 15:02:14",
    "parent_name": "Hummer"
  },
  {
    "id": 395,
    "name": "D90",
    "slug": "d90",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "40",
    "created_at": "2019-08-07 15:02:46",
    "parent_name": "Maxus"
  },
  {
    "id": 396,
    "name": "G10 ",
    "slug": "g10",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "40",
    "created_at": "2019-08-07 15:02:55",
    "parent_name": "Maxus"
  },
  {
    "id": 397,
    "name": "T60 ",
    "slug": "t60",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "40",
    "created_at": "2019-08-07 15:03:04",
    "parent_name": "Maxus"
  },
  {
    "id": 398,
    "name": "V80 ",
    "slug": "v80",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "40",
    "created_at": "2019-08-07 15:03:14",
    "parent_name": "Maxus"
  },
  {
    "id": 399,
    "name": "Veryca ",
    "slug": "veryca",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "41",
    "created_at": "2019-08-07 15:03:39",
    "parent_name": "CMC"
  },
  {
    "id": 400,
    "name": "Z7",
    "slug": "z7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "41",
    "created_at": "2019-08-07 15:03:49",
    "parent_name": "CMC"
  },
  {
    "id": 402,
    "name": "Atos",
    "slug": "atos",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 15:04:22",
    "parent_name": "Hyundai"
  },
  {
    "id": 403,
    "name": "Accent",
    "slug": "accent",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:43:18",
    "parent_name": "Hyundai"
  },
  {
    "id": 404,
    "name": "Avanti",
    "slug": "avanti",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:43:32",
    "parent_name": "Hyundai"
  },
  {
    "id": 405,
    "name": "Azera",
    "slug": "azera",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:47:05",
    "parent_name": "Hyundai"
  },
  {
    "id": 406,
    "name": "Centennial",
    "slug": "centennial",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:47:19",
    "parent_name": "Hyundai"
  },
  {
    "id": 407,
    "name": "Coupe",
    "slug": "coupe-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:47:29",
    "parent_name": "Hyundai"
  },
  {
    "id": 408,
    "name": "Creta",
    "slug": "creta-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:47:47",
    "parent_name": "Hyundai"
  },
  {
    "id": 409,
    "name": "Elantra",
    "slug": "elantra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:48:33",
    "parent_name": "Hyundai"
  },
  {
    "id": 410,
    "name": "Entourage",
    "slug": "entourage",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:49:04",
    "parent_name": "Hyundai"
  },
  {
    "id": 411,
    "name": "Excel",
    "slug": "excel",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:49:51",
    "parent_name": "Hyundai"
  },
  {
    "id": 412,
    "name": "Galloper",
    "slug": "galloper",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:50:52",
    "parent_name": "Hyundai"
  },
  {
    "id": 413,
    "name": "Genesis",
    "slug": "genesis",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:51:01",
    "parent_name": "Hyundai"
  },
  {
    "id": 414,
    "name": "Getz",
    "slug": "getz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:51:10",
    "parent_name": "Hyundai"
  },
  {
    "id": 415,
    "name": "Grandeur",
    "slug": "grandeur",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:51:19",
    "parent_name": "Hyundai"
  },
  {
    "id": 416,
    "name": "H1",
    "slug": "h1-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:51:28",
    "parent_name": "Hyundai"
  },
  {
    "id": 417,
    "name": "Matrix",
    "slug": "matrix",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:51:52",
    "parent_name": "Hyundai"
  },
  {
    "id": 418,
    "name": "Santa Fe",
    "slug": "santa-fe",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:52:03",
    "parent_name": "Hyundai"
  },
  {
    "id": 419,
    "name": "Sonata",
    "slug": "sonata",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:52:12",
    "parent_name": "Hyundai"
  },
  {
    "id": 420,
    "name": "Terracan",
    "slug": "terracan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:52:23",
    "parent_name": "Hyundai"
  },
  {
    "id": 421,
    "name": "Tiburon",
    "slug": "tiburon",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:52:35",
    "parent_name": "Hyundai"
  },
  {
    "id": 422,
    "name": "Trajet",
    "slug": "trajet",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:52:45",
    "parent_name": "Hyundai"
  },
  {
    "id": 423,
    "name": "Tucson",
    "slug": "tucson",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:05",
    "parent_name": "Hyundai"
  },
  {
    "id": 424,
    "name": "Veloster",
    "slug": "veloster",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:18",
    "parent_name": "Hyundai"
  },
  {
    "id": 425,
    "name": "Veracruz",
    "slug": "veracruz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:27",
    "parent_name": "Hyundai"
  },
  {
    "id": 426,
    "name": "Verna",
    "slug": "verna",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:36",
    "parent_name": "Hyundai"
  },
  {
    "id": 427,
    "name": "i10",
    "slug": "i10",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:47",
    "parent_name": "Hyundai"
  },
  {
    "id": 428,
    "name": "i20",
    "slug": "i20",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:53:56",
    "parent_name": "Hyundai"
  },
  {
    "id": 429,
    "name": "i30",
    "slug": "i30",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:54:05",
    "parent_name": "Hyundai"
  },
  {
    "id": 430,
    "name": "i40",
    "slug": "i40",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "42",
    "created_at": "2019-08-07 16:54:31",
    "parent_name": "Hyundai"
  },
  {
    "id": 431,
    "name": "57 ",
    "slug": "57",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "43",
    "created_at": "2019-08-07 16:55:09",
    "parent_name": "Maybach"
  },
  {
    "id": 432,
    "name": "62 ",
    "slug": "62",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "43",
    "created_at": "2019-08-07 16:55:18",
    "parent_name": "Maybach"
  },
  {
    "id": 433,
    "name": "S500 ",
    "slug": "s500",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "43",
    "created_at": "2019-08-07 16:55:28",
    "parent_name": "Maybach"
  },
  {
    "id": 434,
    "name": "Other ",
    "slug": "other-39",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "43",
    "created_at": "2019-08-07 16:55:37",
    "parent_name": "Maybach"
  },
  {
    "id": 435,
    "name": "BRZ ",
    "slug": "brz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:56:04",
    "parent_name": "Subaru"
  },
  {
    "id": 436,
    "name": "Forester ",
    "slug": "forester",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:56:31",
    "parent_name": "Subaru"
  },
  {
    "id": 437,
    "name": "Impreza ",
    "slug": "impreza",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:56:39",
    "parent_name": "Subaru"
  },
  {
    "id": 438,
    "name": "Legacy ",
    "slug": "legacy",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:56:49",
    "parent_name": "Subaru"
  },
  {
    "id": 439,
    "name": "Outback ",
    "slug": "outback",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:57:03",
    "parent_name": "Subaru"
  },
  {
    "id": 440,
    "name": "Tribeca",
    "slug": "tribeca",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:57:12",
    "parent_name": "Subaru"
  },
  {
    "id": 441,
    "name": "WRX ",
    "slug": "wrx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "44",
    "created_at": "2019-08-07 16:57:21",
    "parent_name": "Subaru"
  },
  {
    "id": 442,
    "name": "ATS",
    "slug": "ats-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:12:04",
    "parent_name": "Cadillac"
  },
  {
    "id": 443,
    "name": "BLS",
    "slug": "bls",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:12:16",
    "parent_name": "Cadillac"
  },
  {
    "id": 444,
    "name": "CT6",
    "slug": "ct6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:12:26",
    "parent_name": "Cadillac"
  },
  {
    "id": 445,
    "name": "CTS/Catera",
    "slug": "cts-catera",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:12:38",
    "parent_name": "Cadillac"
  },
  {
    "id": 446,
    "name": "DTS/De Ville",
    "slug": "dts-de-ville",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:12:49",
    "parent_name": "Cadillac"
  },
  {
    "id": 447,
    "name": "Escalade",
    "slug": "escalade",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:01",
    "parent_name": "Cadillac"
  },
  {
    "id": 448,
    "name": "Fleetwood",
    "slug": "fleetwood",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:11",
    "parent_name": "Cadillac"
  },
  {
    "id": 449,
    "name": "SRX",
    "slug": "srx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:22",
    "parent_name": "Cadillac"
  },
  {
    "id": 450,
    "name": "STS/Seville",
    "slug": "sts-seville",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:32",
    "parent_name": "Cadillac"
  },
  {
    "id": 451,
    "name": "XLR",
    "slug": "xlr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:43",
    "parent_name": "Cadillac"
  },
  {
    "id": 452,
    "name": "XT5",
    "slug": "xt5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:13:52",
    "parent_name": "Cadillac"
  },
  {
    "id": 453,
    "name": "XTR/Eldorado",
    "slug": "xtr-eldorado",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:14:01",
    "parent_name": "Cadillac"
  },
  {
    "id": 454,
    "name": "XTS",
    "slug": "xts",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "45",
    "created_at": "2019-08-07 17:14:11",
    "parent_name": "Cadillac"
  },
  {
    "id": 455,
    "name": "FX45/FX35",
    "slug": "fx45-fx35",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:30:37",
    "parent_name": "Infiniti"
  },
  {
    "id": 456,
    "name": "FX50",
    "slug": "fx50",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:30:49",
    "parent_name": "Infiniti"
  },
  {
    "id": 457,
    "name": "G-Series",
    "slug": "g-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:30:59",
    "parent_name": "Infiniti"
  },
  {
    "id": 458,
    "name": "G25",
    "slug": "g25",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:31:11",
    "parent_name": "Infiniti"
  },
  {
    "id": 459,
    "name": "I35/I30",
    "slug": "i35-i30",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:31:22",
    "parent_name": "Infiniti"
  },
  {
    "id": 460,
    "name": "J30",
    "slug": "j30",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:31:42",
    "parent_name": "Infiniti"
  },
  {
    "id": 461,
    "name": "JX-Series",
    "slug": "jx-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:31:55",
    "parent_name": "Infiniti"
  },
  {
    "id": 462,
    "name": "M-Series",
    "slug": "m-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:32:05",
    "parent_name": "Infiniti"
  },
  {
    "id": 463,
    "name": "Q30",
    "slug": "q30",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:32:17",
    "parent_name": "Infiniti"
  },
  {
    "id": 464,
    "name": "Q40",
    "slug": "q40",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:32:29",
    "parent_name": "Infiniti"
  },
  {
    "id": 465,
    "name": "Q45",
    "slug": "q45",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:33:03",
    "parent_name": "Infiniti"
  },
  {
    "id": 466,
    "name": "Q50",
    "slug": "q50",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:33:15",
    "parent_name": "Infiniti"
  },
  {
    "id": 467,
    "name": "Q60",
    "slug": "q60",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:33:25",
    "parent_name": "Infiniti"
  },
  {
    "id": 468,
    "name": "Q70",
    "slug": "q70",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:33:41",
    "parent_name": "Infiniti"
  },
  {
    "id": 469,
    "name": "QX4",
    "slug": "qx4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:33:52",
    "parent_name": "Infiniti"
  },
  {
    "id": 470,
    "name": "QX50",
    "slug": "qx50",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:34:02",
    "parent_name": "Infiniti"
  },
  {
    "id": 471,
    "name": "QX56",
    "slug": "qx56",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:34:13",
    "parent_name": "Infiniti"
  },
  {
    "id": 472,
    "name": "QX60",
    "slug": "qx60",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:34:23",
    "parent_name": "Infiniti"
  },
  {
    "id": 473,
    "name": "QX70",
    "slug": "qx70",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:34:50",
    "parent_name": "Infiniti"
  },
  {
    "id": 474,
    "name": "QX80",
    "slug": "qx80",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:34:59",
    "parent_name": "Infiniti"
  },
  {
    "id": 475,
    "name": "Other",
    "slug": "other-40",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "46",
    "created_at": "2019-08-07 17:35:31",
    "parent_name": "Infiniti"
  },
  {
    "id": 476,
    "name": "2",
    "slug": "2-57",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:36:48",
    "parent_name": "Mazda"
  },
  {
    "id": 477,
    "name": "3",
    "slug": "3-55",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:36:58",
    "parent_name": "Mazda"
  },
  {
    "id": 478,
    "name": "323",
    "slug": "323",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:37:08",
    "parent_name": "Mazda"
  },
  {
    "id": 479,
    "name": "6",
    "slug": "6-33",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:37:18",
    "parent_name": "Mazda"
  },
  {
    "id": 480,
    "name": "626",
    "slug": "626",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:37:27",
    "parent_name": "Mazda"
  },
  {
    "id": 481,
    "name": "929",
    "slug": "929",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:37:38",
    "parent_name": "Mazda"
  },
  {
    "id": 482,
    "name": "CX-3",
    "slug": "cx-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:37:49",
    "parent_name": "Mazda"
  },
  {
    "id": 483,
    "name": "CX-5",
    "slug": "cx-5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:38:00",
    "parent_name": "Mazda"
  },
  {
    "id": 484,
    "name": "CX-7",
    "slug": "cx-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:38:11",
    "parent_name": "Mazda"
  },
  {
    "id": 485,
    "name": "CX-9",
    "slug": "cx-9",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:38:22",
    "parent_name": "Mazda"
  },
  {
    "id": 486,
    "name": "MPV",
    "slug": "mpv-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:38:38",
    "parent_name": "Mazda"
  },
  {
    "id": 487,
    "name": "MX-5",
    "slug": "mx-5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:38:57",
    "parent_name": "Mazda"
  },
  {
    "id": 488,
    "name": "MX-6",
    "slug": "mx-6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:39:06",
    "parent_name": "Mazda"
  },
  {
    "id": 489,
    "name": "Navajo",
    "slug": "navajo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:39:16",
    "parent_name": "Mazda"
  },
  {
    "id": 490,
    "name": "Pickup",
    "slug": "pickup-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:39:29",
    "parent_name": "Mazda"
  },
  {
    "id": 491,
    "name": "Protégé",
    "slug": "prot-g",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:39:55",
    "parent_name": "Mazda"
  },
  {
    "id": 492,
    "name": "RX-7",
    "slug": "rx-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:40:05",
    "parent_name": "Mazda"
  },
  {
    "id": 493,
    "name": "RX-8",
    "slug": "rx-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:40:29",
    "parent_name": "Mazda"
  },
  {
    "id": 494,
    "name": "Tribute",
    "slug": "tribute",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:40:39",
    "parent_name": "Mazda"
  },
  {
    "id": 495,
    "name": "Other",
    "slug": "other-41",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "47",
    "created_at": "2019-08-07 17:41:49",
    "parent_name": "Mazda"
  },
  {
    "id": 496,
    "name": "APV Van ",
    "slug": "apv-van",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:42:18",
    "parent_name": "Suzuki"
  },
  {
    "id": 497,
    "name": "Alto ",
    "slug": "alto",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:42:41",
    "parent_name": "Suzuki"
  },
  {
    "id": 498,
    "name": "Celerio ",
    "slug": "celerio",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:43:04",
    "parent_name": "Suzuki"
  },
  {
    "id": 499,
    "name": "Ciaz ",
    "slug": "ciaz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:43:14",
    "parent_name": "Suzuki"
  },
  {
    "id": 500,
    "name": "Grand Vitara",
    "slug": "grand-vitara",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:43:38",
    "parent_name": "Suzuki"
  },
  {
    "id": 501,
    "name": "Jimny ",
    "slug": "jimny",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:43:51",
    "parent_name": "Suzuki"
  },
  {
    "id": 502,
    "name": "Kizashi",
    "slug": "kizashi",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:44:05",
    "parent_name": "Suzuki"
  },
  {
    "id": 503,
    "name": "SX4 ",
    "slug": "sx4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:44:14",
    "parent_name": "Suzuki"
  },
  {
    "id": 504,
    "name": "Swift ",
    "slug": "swift",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:44:24",
    "parent_name": "Suzuki"
  },
  {
    "id": 505,
    "name": "Vitara ",
    "slug": "vitara-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:44:33",
    "parent_name": "Suzuki"
  },
  {
    "id": 506,
    "name": "XL7 ",
    "slug": "xl7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:44:44",
    "parent_name": "Suzuki"
  },
  {
    "id": 507,
    "name": "Mehran",
    "slug": "mehran",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:47:12",
    "parent_name": "Suzuki"
  },
  {
    "id": 508,
    "name": "Gli",
    "slug": "gli-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:48:51",
    "parent_name": "Suzuki"
  },
  {
    "id": 509,
    "name": "Other ",
    "slug": "other-42",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "48",
    "created_at": "2019-08-07 17:49:23",
    "parent_name": "Suzuki"
  },
  {
    "id": 510,
    "name": "Amigo",
    "slug": "amigo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:57:58",
    "parent_name": "Isuzu"
  },
  {
    "id": 511,
    "name": "Ascender",
    "slug": "ascender",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:58:08",
    "parent_name": "Isuzu"
  },
  {
    "id": 512,
    "name": "Axiom",
    "slug": "axiom",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:58:19",
    "parent_name": "Isuzu"
  },
  {
    "id": 513,
    "name": "I Mark",
    "slug": "i-mark",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:58:32",
    "parent_name": "Isuzu"
  },
  {
    "id": 514,
    "name": "Impulse",
    "slug": "impulse",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:58:43",
    "parent_name": "Isuzu"
  },
  {
    "id": 515,
    "name": "Oasis",
    "slug": "oasis",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:59:06",
    "parent_name": "Isuzu"
  },
  {
    "id": 516,
    "name": "Rodeo",
    "slug": "rodeo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:59:18",
    "parent_name": "Isuzu"
  },
  {
    "id": 517,
    "name": "Stylus",
    "slug": "stylus",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:59:27",
    "parent_name": "Isuzu"
  },
  {
    "id": 518,
    "name": "Trooper",
    "slug": "trooper",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:59:37",
    "parent_name": "Isuzu"
  },
  {
    "id": 519,
    "name": "i-Series",
    "slug": "i-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 17:59:53",
    "parent_name": "Isuzu"
  },
  {
    "id": 520,
    "name": "Other",
    "slug": "other-43",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "49",
    "created_at": "2019-08-07 18:00:03",
    "parent_name": "Isuzu"
  },
  {
    "id": 521,
    "name": "540C",
    "slug": "540c",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:00:52",
    "parent_name": "McLaren"
  },
  {
    "id": 522,
    "name": "570GT",
    "slug": "570gt",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:01",
    "parent_name": "McLaren"
  },
  {
    "id": 523,
    "name": "570S",
    "slug": "570s",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:14",
    "parent_name": "McLaren"
  },
  {
    "id": 524,
    "name": "650S",
    "slug": "650s",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:26",
    "parent_name": "McLaren"
  },
  {
    "id": 525,
    "name": "675LT",
    "slug": "675lt",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:36",
    "parent_name": "McLaren"
  },
  {
    "id": 526,
    "name": "675LT",
    "slug": "675lt-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:47",
    "parent_name": "McLaren"
  },
  {
    "id": 527,
    "name": "F1",
    "slug": "f1-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:01:57",
    "parent_name": "McLaren"
  },
  {
    "id": 528,
    "name": "MP4-12C",
    "slug": "mp4-12c",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:02:08",
    "parent_name": "McLaren"
  },
  {
    "id": 529,
    "name": "P1",
    "slug": "p1",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:02:20",
    "parent_name": "McLaren"
  },
  {
    "id": 530,
    "name": "SLR",
    "slug": "slr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:02:32",
    "parent_name": "McLaren"
  },
  {
    "id": 531,
    "name": "Senna",
    "slug": "senna",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "50",
    "created_at": "2019-08-07 18:02:45",
    "parent_name": "McLaren"
  },
  {
    "id": 532,
    "name": "Delivery Truck",
    "slug": "delivery-truck",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "51",
    "created_at": "2019-08-07 18:03:13",
    "parent_name": "TATA"
  },
  {
    "id": 533,
    "name": "Pickup",
    "slug": "pickup-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "51",
    "created_at": "2019-08-07 18:03:23",
    "parent_name": "TATA"
  },
  {
    "id": 534,
    "name": "Van",
    "slug": "van-10",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "51",
    "created_at": "2019-08-07 18:03:44",
    "parent_name": "TATA"
  },
  {
    "id": 535,
    "name": "Alswin",
    "slug": "alswin",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "52",
    "created_at": "2019-08-07 18:04:08",
    "parent_name": "Changan"
  },
  {
    "id": 536,
    "name": "CS95",
    "slug": "cs95",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "52",
    "created_at": "2019-08-07 18:04:19",
    "parent_name": "Changan"
  },
  {
    "id": 537,
    "name": "Cs35",
    "slug": "cs35",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "52",
    "created_at": "2019-08-07 18:04:32",
    "parent_name": "Changan"
  },
  {
    "id": 538,
    "name": "Cs75",
    "slug": "cs75",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "52",
    "created_at": "2019-08-07 18:04:47",
    "parent_name": "Changan"
  },
  {
    "id": 539,
    "name": "Eado",
    "slug": "eado",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "52",
    "created_at": "2019-08-07 18:04:56",
    "parent_name": "Changan"
  },
  {
    "id": 540,
    "name": "City Bus",
    "slug": "city-bus",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "53",
    "created_at": "2019-08-08 12:09:26",
    "parent_name": "JAC"
  },
  {
    "id": 541,
    "name": "HK6730",
    "slug": "hk6730",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "53",
    "created_at": "2019-08-08 12:09:37",
    "parent_name": "JAC"
  },
  {
    "id": 542,
    "name": "S3",
    "slug": "s3-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "53",
    "created_at": "2019-08-08 12:09:47",
    "parent_name": "JAC"
  },
  {
    "id": 543,
    "name": "T6 Pickup",
    "slug": "t6-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "53",
    "created_at": "2019-08-08 12:10:02",
    "parent_name": "JAC"
  },
  {
    "id": 544,
    "name": "Tourist Bus",
    "slug": "tourist-bus",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "53",
    "created_at": "2019-08-08 12:10:15",
    "parent_name": "JAC"
  },
  {
    "id": 545,
    "name": "190 ",
    "slug": "190",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:10:46",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 546,
    "name": "240/260/280",
    "slug": "240-260-280",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:11:01",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 547,
    "name": "300/350/380",
    "slug": "300-350-380",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:11:13",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 548,
    "name": "400/420 ‬ ‫",
    "slug": "400-420",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:17:04",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 549,
    "name": "450 SEL ‬ ‫",
    "slug": "450-sel",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:17:18",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 550,
    "name": "500/560 ",
    "slug": "500-560",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:17:31",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 551,
    "name": "A-Class ‬ ‫",
    "slug": "a-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:17:57",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 552,
    "name": "A200 ",
    "slug": "a200",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:19:02",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 553,
    "name": "AMG ",
    "slug": "amg",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:19:14",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 554,
    "name": "B-Class  ",
    "slug": "b-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:19:25",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 555,
    "name": "C-Class ‬ ",
    "slug": "c-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:19:41",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 556,
    "name": "C43 ",
    "slug": "c43",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:19:52",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 557,
    "name": "CL-Class ‬",
    "slug": "cl-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:20:04",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 558,
    "name": "CLA ",
    "slug": "cla-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:20:15",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 559,
    "name": "CLC ",
    "slug": "clc",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:20:27",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 560,
    "name": "CLK-Class ",
    "slug": "clk-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:20:43",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 561,
    "name": "CLS-Class ‬",
    "slug": "cls-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:20:54",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 562,
    "name": "E-Class ‬ ‫",
    "slug": "e-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:21:05",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 563,
    "name": "G-Class ‬",
    "slug": "g-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:21:16",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 564,
    "name": "GL-Class ",
    "slug": "gl-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:21:34",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 565,
    "name": "GLA ",
    "slug": "gla-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:22:51",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 566,
    "name": "GLC ",
    "slug": "glc",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:23:03",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 567,
    "name": "GLE Coupe",
    "slug": "gle-coupe",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:23:13",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 568,
    "name": "GLE SUV ‬ ‫",
    "slug": "gle-suv",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:23:24",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 569,
    "name": "GLK-Class ",
    "slug": "glk-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:23:38",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 570,
    "name": "GLS ",
    "slug": "gls",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:23:49",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 571,
    "name": "GT ",
    "slug": "gt-11",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:24:00",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 572,
    "name": "M-Class ",
    "slug": "m-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:24:10",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 573,
    "name": "R-Class ‬ ‫",
    "slug": "r-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:24:20",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 574,
    "name": "S-Class ‬ ‫",
    "slug": "s-class-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:24:32",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 575,
    "name": "SL-Class",
    "slug": "sl-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:24:49",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 576,
    "name": "SLC ",
    "slug": "slc",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:25:03",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 577,
    "name": "SLK-Class ",
    "slug": "slk-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:25:15",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 578,
    "name": "SLR ",
    "slug": "slr-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:25:26",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 579,
    "name": "SLS ",
    "slug": "sls",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:25:48",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 580,
    "name": "Sprinter ",
    "slug": "sprinter",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:26:09",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 581,
    "name": "Viano ",
    "slug": "viano",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:26:23",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 582,
    "name": "Other ",
    "slug": "other-44",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "54",
    "created_at": "2019-08-08 12:26:35",
    "parent_name": "Mercedes-Benz"
  },
  {
    "id": 583,
    "name": "Model 3",
    "slug": "model-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "55",
    "created_at": "2019-08-08 12:27:25",
    "parent_name": "Tesla"
  },
  {
    "id": 584,
    "name": "Model S",
    "slug": "model-s",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "55",
    "created_at": "2019-08-08 12:27:37",
    "parent_name": "Tesla"
  },
  {
    "id": 585,
    "name": "Model X",
    "slug": "model-x",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "55",
    "created_at": "2019-08-08 12:27:54",
    "parent_name": "Tesla"
  },
  {
    "id": 586,
    "name": "Tesla Roadster",
    "slug": "tesla-roadster",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "55",
    "created_at": "2019-08-08 12:28:12",
    "parent_name": "Tesla"
  },
  {
    "id": 587,
    "name": "Arrizo 7",
    "slug": "arrizo-7",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "56",
    "created_at": "2019-08-08 12:29:03",
    "parent_name": "Chery"
  },
  {
    "id": 588,
    "name": "E5",
    "slug": "e5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "56",
    "created_at": "2019-08-08 12:29:24",
    "parent_name": "Chery"
  },
  {
    "id": 589,
    "name": "Tiggo 3",
    "slug": "tiggo-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "56",
    "created_at": "2019-08-08 12:29:35",
    "parent_name": "Chery"
  },
  {
    "id": 590,
    "name": "Tiggo 5",
    "slug": "tiggo-5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "56",
    "created_at": "2019-08-08 12:29:47",
    "parent_name": "Chery"
  },
  {
    "id": 591,
    "name": "NHR ",
    "slug": "nhr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "57",
    "created_at": "2019-08-08 12:30:24",
    "parent_name": "JMC"
  },
  {
    "id": 592,
    "name": "NKR ",
    "slug": "nkr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "57",
    "created_at": "2019-08-08 12:30:50",
    "parent_name": "JMC"
  },
  {
    "id": 593,
    "name": "Grand Marquis",
    "slug": "grand-marquis",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:33:36",
    "parent_name": "Mercury"
  },
  {
    "id": 594,
    "name": "Mariner",
    "slug": "mariner",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:33:48",
    "parent_name": "Mercury"
  },
  {
    "id": 595,
    "name": "Milan",
    "slug": "milan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:34:17",
    "parent_name": "Mercury"
  },
  {
    "id": 596,
    "name": "Montego",
    "slug": "montego",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:34:53",
    "parent_name": "Mercury"
  },
  {
    "id": 597,
    "name": "Mountaineer",
    "slug": "mountaineer",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:35:05",
    "parent_name": "Mercury"
  },
  {
    "id": 598,
    "name": "Other",
    "slug": "other-45",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "58",
    "created_at": "2019-08-08 12:35:21",
    "parent_name": "Mercury"
  },
  {
    "id": 599,
    "name": "4Runner ",
    "slug": "4runner",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:35:52",
    "parent_name": "Toyota"
  },
  {
    "id": 600,
    "name": "86 ",
    "slug": "86",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:02",
    "parent_name": "Toyota"
  },
  {
    "id": 601,
    "name": "Alphard ",
    "slug": "alphard",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:15",
    "parent_name": "Toyota"
  },
  {
    "id": 602,
    "name": "Alphard ",
    "slug": "alphard-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:21",
    "parent_name": "Toyota"
  },
  {
    "id": 603,
    "name": "Aurion ",
    "slug": "aurion",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:33",
    "parent_name": "Toyota"
  },
  {
    "id": 604,
    "name": "Avalon ",
    "slug": "avalon",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:48",
    "parent_name": "Toyota"
  },
  {
    "id": 605,
    "name": "Avanza ",
    "slug": "avanza",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:36:59",
    "parent_name": "Toyota"
  },
  {
    "id": 606,
    "name": "C-HR ‬ ‫",
    "slug": "c-hr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:37:10",
    "parent_name": "Toyota"
  },
  {
    "id": 607,
    "name": "Camry ",
    "slug": "camry",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:37:21",
    "parent_name": "Toyota"
  },
  {
    "id": 608,
    "name": "Celica ",
    "slug": "celica",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:37:36",
    "parent_name": "Toyota"
  },
  {
    "id": 609,
    "name": "Corolla ",
    "slug": "corolla",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:37:48",
    "parent_name": "Toyota"
  },
  {
    "id": 610,
    "name": "Echo ",
    "slug": "echo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:38:00",
    "parent_name": "Toyota"
  },
  {
    "id": 611,
    "name": "FJ Cruiser ",
    "slug": "fj-cruiser",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:38:12",
    "parent_name": "Toyota"
  },
  {
    "id": 612,
    "name": "Fortuner ",
    "slug": "fortuner",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:38:27",
    "parent_name": "Toyota"
  },
  {
    "id": 613,
    "name": "Hiace ",
    "slug": "hiace",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:38:42",
    "parent_name": "Toyota"
  },
  {
    "id": 614,
    "name": "Highlander",
    "slug": "highlander",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:38:52",
    "parent_name": "Toyota"
  },
  {
    "id": 615,
    "name": "Hilux ",
    "slug": "hilux",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:39:12",
    "parent_name": "Toyota"
  },
  {
    "id": 616,
    "name": "IQ ",
    "slug": "iq",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:39:23",
    "parent_name": "Toyota"
  },
  {
    "id": 617,
    "name": "Innova",
    "slug": "innova",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:39:35",
    "parent_name": "Toyota"
  },
  {
    "id": 618,
    "name": "Land Cruiser ",
    "slug": "land-cruiser",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:39:45",
    "parent_name": "Toyota"
  },
  {
    "id": 619,
    "name": "Land Cruiser 76 series ",
    "slug": "land-cruiser-76-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:39:57",
    "parent_name": "Toyota"
  },
  {
    "id": 620,
    "name": "Pickup ",
    "slug": "pickup-10",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:40:30",
    "parent_name": "Toyota"
  },
  {
    "id": 621,
    "name": "Prado ",
    "slug": "prado",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:40:41",
    "parent_name": "Toyota"
  },
  {
    "id": 622,
    "name": "Previa ",
    "slug": "previa",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:41:08",
    "parent_name": "Toyota"
  },
  {
    "id": 623,
    "name": "Prius ",
    "slug": "prius",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:41:19",
    "parent_name": "Toyota"
  },
  {
    "id": 624,
    "name": "Rav 4",
    "slug": "rav-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:41:31",
    "parent_name": "Toyota"
  },
  {
    "id": 625,
    "name": "Rush ",
    "slug": "rush",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:41:48",
    "parent_name": "Toyota"
  },
  {
    "id": 626,
    "name": "Sequoia ",
    "slug": "sequoia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:41:59",
    "parent_name": "Toyota"
  },
  {
    "id": 627,
    "name": "Sienna ",
    "slug": "sienna-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:42:10",
    "parent_name": "Toyota"
  },
  {
    "id": 628,
    "name": "Tacoma",
    "slug": "tacoma",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:42:23",
    "parent_name": "Toyota"
  },
  {
    "id": 629,
    "name": "Tundra ",
    "slug": "tundra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:42:35",
    "parent_name": "Toyota"
  },
  {
    "id": 630,
    "name": "XA ",
    "slug": "xa",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:42:45",
    "parent_name": "Toyota"
  },
  {
    "id": 631,
    "name": "Yaris ",
    "slug": "yaris",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:42:57",
    "parent_name": "Toyota"
  },
  {
    "id": 632,
    "name": "Zelas ",
    "slug": "zelas",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:43:07",
    "parent_name": "Toyota"
  },
  {
    "id": 633,
    "name": "Other",
    "slug": "other-46",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "59",
    "created_at": "2019-08-08 12:43:24",
    "parent_name": "Toyota"
  },
  {
    "id": 634,
    "name": "Astro ",
    "slug": "astro",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:43:57",
    "parent_name": "Chevrolet"
  },
  {
    "id": 635,
    "name": "Avalanche ",
    "slug": "avalanche",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:44:09",
    "parent_name": "Chevrolet"
  },
  {
    "id": 636,
    "name": "Aveo ",
    "slug": "aveo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:44:22",
    "parent_name": "Chevrolet"
  },
  {
    "id": 637,
    "name": "CSV ",
    "slug": "csv",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:44:50",
    "parent_name": "Chevrolet"
  },
  {
    "id": 638,
    "name": "Camaro ",
    "slug": "camaro",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:45:09",
    "parent_name": "Chevrolet"
  },
  {
    "id": 639,
    "name": "Caprice ",
    "slug": "caprice",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:45:21",
    "parent_name": "Chevrolet"
  },
  {
    "id": 640,
    "name": "Captiva ",
    "slug": "captiva",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:45:35",
    "parent_name": "Chevrolet"
  },
  {
    "id": 641,
    "name": "Cavalier ‬",
    "slug": "cavalier",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:45:49",
    "parent_name": "Chevrolet"
  },
  {
    "id": 642,
    "name": "Cavalier ‬",
    "slug": "cavalier-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:46:06",
    "parent_name": "Chevrolet"
  },
  {
    "id": 643,
    "name": "Corvette ",
    "slug": "corvette",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:46:18",
    "parent_name": "Chevrolet"
  },
  {
    "id": 644,
    "name": "Cruze ",
    "slug": "cruze",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:46:29",
    "parent_name": "Chevrolet"
  },
  {
    "id": 645,
    "name": "Epica ",
    "slug": "epica",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:46:44",
    "parent_name": "Chevrolet"
  },
  {
    "id": 646,
    "name": "Equinox ",
    "slug": "equinox",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:47:01",
    "parent_name": "Chevrolet"
  },
  {
    "id": 647,
    "name": "Express ",
    "slug": "express",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:47:13",
    "parent_name": "Chevrolet"
  },
  {
    "id": 648,
    "name": "HHR ",
    "slug": "hhr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:47:27",
    "parent_name": "Chevrolet"
  },
  {
    "id": 649,
    "name": "Impala ",
    "slug": "impala",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:47:39",
    "parent_name": "Chevrolet"
  },
  {
    "id": 650,
    "name": "Lumina ",
    "slug": "lumina",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:47:50",
    "parent_name": "Chevrolet"
  },
  {
    "id": 651,
    "name": "Malibu ",
    "slug": "malibu",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:48:02",
    "parent_name": "Chevrolet"
  },
  {
    "id": 652,
    "name": "Optra ",
    "slug": "optra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:48:13",
    "parent_name": "Chevrolet"
  },
  {
    "id": 653,
    "name": "Pickup ",
    "slug": "pickup-11",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:48:24",
    "parent_name": "Chevrolet"
  },
  {
    "id": 654,
    "name": "Silverado ",
    "slug": "silverado",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:48:39",
    "parent_name": "Chevrolet"
  },
  {
    "id": 655,
    "name": "Sonic ",
    "slug": "sonic",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:49:07",
    "parent_name": "Chevrolet"
  },
  {
    "id": 656,
    "name": "Spark ",
    "slug": "spark",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:49:19",
    "parent_name": "Chevrolet"
  },
  {
    "id": 657,
    "name": "Suburban ",
    "slug": "suburban-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:49:30",
    "parent_name": "Chevrolet"
  },
  {
    "id": 658,
    "name": "Tahoe ",
    "slug": "tahoe",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:49:42",
    "parent_name": "Chevrolet"
  },
  {
    "id": 659,
    "name": "Trailblazer",
    "slug": "trailblazer",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:49:56",
    "parent_name": "Chevrolet"
  },
  {
    "id": 660,
    "name": "Traverse ",
    "slug": "traverse",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:50:09",
    "parent_name": "Chevrolet"
  },
  {
    "id": 661,
    "name": "Trax ",
    "slug": "trax",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:50:24",
    "parent_name": "Chevrolet"
  },
  {
    "id": 662,
    "name": "Other",
    "slug": "other-47",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "60",
    "created_at": "2019-08-08 12:50:35",
    "parent_name": "Chevrolet"
  },
  {
    "id": 663,
    "name": "E-Type ‬ ‫",
    "slug": "e-type",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:51:00",
    "parent_name": "Jaguar"
  },
  {
    "id": 664,
    "name": "F-Pace ‬ ‫",
    "slug": "f-pace",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:51:12",
    "parent_name": "Jaguar"
  },
  {
    "id": 665,
    "name": "F-Type ‬ ",
    "slug": "f-type",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:51:33",
    "parent_name": "Jaguar"
  },
  {
    "id": 666,
    "name": "S-Type ‬ ‫",
    "slug": "s-type",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:51:43",
    "parent_name": "Jaguar"
  },
  {
    "id": 667,
    "name": "X-Type ‬ ",
    "slug": "x-type",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:52:06",
    "parent_name": "Jaguar"
  },
  {
    "id": 668,
    "name": "XE ",
    "slug": "xe-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:52:16",
    "parent_name": "Jaguar"
  },
  {
    "id": 669,
    "name": "XF ",
    "slug": "xf",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:52:28",
    "parent_name": "Jaguar"
  },
  {
    "id": 670,
    "name": "XJ-Series ",
    "slug": "xj-series",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:52:40",
    "parent_name": "Jaguar"
  },
  {
    "id": 671,
    "name": "XJ6 ",
    "slug": "xj6",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:53:11",
    "parent_name": "Jaguar"
  },
  {
    "id": 672,
    "name": "XJ8 ",
    "slug": "xj8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:53:23",
    "parent_name": "Jaguar"
  },
  {
    "id": 673,
    "name": "XJR ",
    "slug": "xjr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:53:35",
    "parent_name": "Jaguar"
  },
  {
    "id": 674,
    "name": "XJS ",
    "slug": "xjs",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:53:48",
    "parent_name": "Jaguar"
  },
  {
    "id": 675,
    "name": "XK ",
    "slug": "xk",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:54:00",
    "parent_name": "Jaguar"
  },
  {
    "id": 676,
    "name": "XK8",
    "slug": "xk8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:54:19",
    "parent_name": "Jaguar"
  },
  {
    "id": 677,
    "name": "XKR",
    "slug": "xkr",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:54:33",
    "parent_name": "Jaguar"
  },
  {
    "id": 678,
    "name": "Other ",
    "slug": "other-48",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "61",
    "created_at": "2019-08-08 12:54:46",
    "parent_name": "Jaguar"
  },
  {
    "id": 679,
    "name": "ASX ",
    "slug": "asx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:55:18",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 680,
    "name": "Attrage ",
    "slug": "attrage",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:55:30",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 681,
    "name": "Canter ",
    "slug": "canter",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:55:41",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 682,
    "name": "Eclipse ",
    "slug": "eclipse",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:55:54",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 683,
    "name": "Evolution ",
    "slug": "evolution",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:56:06",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 684,
    "name": "Galant ",
    "slug": "galant",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:56:18",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 685,
    "name": "L200 ",
    "slug": "l200",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:56:29",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 686,
    "name": "Lancer ",
    "slug": "lancer",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:56:46",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 687,
    "name": "Magna ",
    "slug": "magna",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:56:57",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 688,
    "name": "Mirage ",
    "slug": "mirage",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:57:08",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 689,
    "name": "Montero ",
    "slug": "montero",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:57:20",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 690,
    "name": "Nativa ",
    "slug": "nativa",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:57:32",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 691,
    "name": "Outlander",
    "slug": "outlander",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:58:07",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 692,
    "name": "Pajero ",
    "slug": "pajero",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:58:28",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 693,
    "name": "Pajero Sport ‬",
    "slug": "pajero-sport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:58:52",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 694,
    "name": "Pickup ",
    "slug": "pickup-12",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 12:59:06",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 695,
    "name": "Van ",
    "slug": "van-12",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 13:00:04",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 696,
    "name": "Other",
    "slug": "other-49",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "62",
    "created_at": "2019-08-08 13:00:15",
    "parent_name": "Mitsubishi"
  },
  {
    "id": 697,
    "name": "Cargo",
    "slug": "cargo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "63",
    "created_at": "2019-08-08 13:00:39",
    "parent_name": "UAZ"
  },
  {
    "id": 698,
    "name": "Commercial",
    "slug": "commercial-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "63",
    "created_at": "2019-08-08 13:01:03",
    "parent_name": "UAZ"
  },
  {
    "id": 699,
    "name": "Hunter",
    "slug": "hunter",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "63",
    "created_at": "2019-08-08 13:01:25",
    "parent_name": "UAZ"
  },
  {
    "id": 700,
    "name": "New Patriot",
    "slug": "new-patriot",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "63",
    "created_at": "2019-08-08 13:01:49",
    "parent_name": "UAZ"
  },
  {
    "id": 701,
    "name": "New Pickup",
    "slug": "new-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "63",
    "created_at": "2019-08-08 13:02:02",
    "parent_name": "UAZ"
  },
  {
    "id": 702,
    "name": "200/200C EV ",
    "slug": "200-200c-ev",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:02:47",
    "parent_name": "Chrysler"
  },
  {
    "id": 703,
    "name": "300M/300C ‬ ‫",
    "slug": "300m-300c",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:03:00",
    "parent_name": "Chrysler"
  },
  {
    "id": 704,
    "name": "PT Cruiser ‬ ‫",
    "slug": "pt-cruiser",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:03:11",
    "parent_name": "Chrysler"
  },
  {
    "id": 705,
    "name": "Concorde",
    "slug": "concorde",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:03:27",
    "parent_name": "Chrysler"
  },
  {
    "id": 706,
    "name": "Crossfire",
    "slug": "crossfire",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:03:40",
    "parent_name": "Chrysler"
  },
  {
    "id": 707,
    "name": "Pacifica ",
    "slug": "pacifica",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:03:53",
    "parent_name": "Chrysler"
  },
  {
    "id": 708,
    "name": "Prowler ",
    "slug": "prowler",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:04:09",
    "parent_name": "Chrysler"
  },
  {
    "id": 709,
    "name": "Prowler ",
    "slug": "prowler-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:04:10",
    "parent_name": "Chrysler"
  },
  {
    "id": 710,
    "name": "Sebring ",
    "slug": "sebring",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:04:21",
    "parent_name": "Chrysler"
  },
  {
    "id": 711,
    "name": "Voyager/Caravan",
    "slug": "voyager-caravan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:04:45",
    "parent_name": "Chrysler"
  },
  {
    "id": 712,
    "name": "Other ",
    "slug": "other-50",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "64",
    "created_at": "2019-08-08 13:05:02",
    "parent_name": "Chrysler"
  },
  {
    "id": 713,
    "name": "Cherokee ",
    "slug": "cherokee",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:05:57",
    "parent_name": "Jeep"
  },
  {
    "id": 714,
    "name": "Commander ",
    "slug": "commander",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:06:27",
    "parent_name": "Jeep"
  },
  {
    "id": 715,
    "name": "Compass ",
    "slug": "compass",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:06:43",
    "parent_name": "Jeep"
  },
  {
    "id": 716,
    "name": "Grand Cherokee ",
    "slug": "grand-cherokee",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:06:56",
    "parent_name": "Jeep"
  },
  {
    "id": 717,
    "name": "Liberty ",
    "slug": "liberty",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:07:22",
    "parent_name": "Jeep"
  },
  {
    "id": 718,
    "name": "Patriot ",
    "slug": "patriot-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:07:40",
    "parent_name": "Jeep"
  },
  {
    "id": 719,
    "name": "Renegade ",
    "slug": "renegade",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:08:56",
    "parent_name": "Jeep"
  },
  {
    "id": 720,
    "name": "Wrangler ‬ ‫",
    "slug": "wrangler",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:09:09",
    "parent_name": "Jeep"
  },
  {
    "id": 721,
    "name": "Wrangler Unlimited ",
    "slug": "wrangler-unlimited",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:09:22",
    "parent_name": "Jeep"
  },
  {
    "id": 722,
    "name": "Other ",
    "slug": "other-51",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "65",
    "created_at": "2019-08-08 13:09:41",
    "parent_name": "Jeep"
  },
  {
    "id": 723,
    "name": "3 Wheeler",
    "slug": "3-wheeler",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:11:07",
    "parent_name": "Morgan"
  },
  {
    "id": 724,
    "name": "4 Seater",
    "slug": "4-seater",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:11:21",
    "parent_name": "Morgan"
  },
  {
    "id": 725,
    "name": "4/4",
    "slug": "4-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:11:34",
    "parent_name": "Morgan"
  },
  {
    "id": 726,
    "name": "Aero 8",
    "slug": "aero-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:11:47",
    "parent_name": "Morgan"
  },
  {
    "id": 727,
    "name": "Aero Coupe",
    "slug": "aero-coupe",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:12:01",
    "parent_name": "Morgan"
  },
  {
    "id": 728,
    "name": "Aero Supersport",
    "slug": "aero-supersport",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:12:20",
    "parent_name": "Morgan"
  },
  {
    "id": 729,
    "name": "Plus 4",
    "slug": "plus-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:12:32",
    "parent_name": "Morgan"
  },
  {
    "id": 730,
    "name": "Plus 8",
    "slug": "plus-8",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:12:47",
    "parent_name": "Morgan"
  },
  {
    "id": 731,
    "name": "Roadster",
    "slug": "roadster-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "66",
    "created_at": "2019-08-08 13:12:59",
    "parent_name": "Morgan"
  },
  {
    "id": 732,
    "name": "Amarok ",
    "slug": "amarok",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:13:29",
    "parent_name": "Volkswagen"
  },
  {
    "id": 733,
    "name": "Beetle ",
    "slug": "beetle",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:14:07",
    "parent_name": "Volkswagen"
  },
  {
    "id": 734,
    "name": "CC ",
    "slug": "cc-15",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:14:23",
    "parent_name": "Volkswagen"
  },
  {
    "id": 735,
    "name": "Caddy ",
    "slug": "caddy",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:14:38",
    "parent_name": "Volkswagen"
  },
  {
    "id": 736,
    "name": "Eos ",
    "slug": "eos-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:15:21",
    "parent_name": "Volkswagen"
  },
  {
    "id": 737,
    "name": "GTI ",
    "slug": "gti",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:15:38",
    "parent_name": "Volkswagen"
  },
  {
    "id": 738,
    "name": "Golf ",
    "slug": "golf",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:15:49",
    "parent_name": "Volkswagen"
  },
  {
    "id": 739,
    "name": "Golf R ",
    "slug": "golf-r",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:16:09",
    "parent_name": "Volkswagen"
  },
  {
    "id": 740,
    "name": "Jetta ",
    "slug": "jetta",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:16:22",
    "parent_name": "Volkswagen"
  },
  {
    "id": 741,
    "name": "Multivan ",
    "slug": "multivan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:16:34",
    "parent_name": "Volkswagen"
  },
  {
    "id": 742,
    "name": "Passat ",
    "slug": "passat",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:16:46",
    "parent_name": "Volkswagen"
  },
  {
    "id": 743,
    "name": "Polo ",
    "slug": "polo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:16:58",
    "parent_name": "Volkswagen"
  },
  {
    "id": 744,
    "name": "Scirocco ",
    "slug": "scirocco",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:17:11",
    "parent_name": "Volkswagen"
  },
  {
    "id": 745,
    "name": "Tiguan ",
    "slug": "tiguan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:17:23",
    "parent_name": "Volkswagen"
  },
  {
    "id": 746,
    "name": "Touareg ",
    "slug": "touareg",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:17:37",
    "parent_name": "Volkswagen"
  },
  {
    "id": 747,
    "name": "Transporter ",
    "slug": "transporter",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:17:48",
    "parent_name": "Volkswagen"
  },
  {
    "id": 748,
    "name": "Other ",
    "slug": "other-52",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "67",
    "created_at": "2019-08-08 13:18:03",
    "parent_name": "Volkswagen"
  },
  {
    "id": 749,
    "name": "AX",
    "slug": "ax-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:19:15",
    "parent_name": "Citroen"
  },
  {
    "id": 750,
    "name": "Berlingo",
    "slug": "berlingo",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:21:03",
    "parent_name": "Citroen"
  },
  {
    "id": 751,
    "name": "C-Elysee",
    "slug": "c-elysee",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:21:24",
    "parent_name": "Citroen"
  },
  {
    "id": 752,
    "name": "C3",
    "slug": "c3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:21:36",
    "parent_name": "Citroen"
  },
  {
    "id": 753,
    "name": "C4",
    "slug": "c4-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:21:48",
    "parent_name": "Citroen"
  },
  {
    "id": 754,
    "name": "C5",
    "slug": "c5",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:22:09",
    "parent_name": "Citroen"
  },
  {
    "id": 755,
    "name": "DS 3",
    "slug": "ds-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:22:21",
    "parent_name": "Citroen"
  },
  {
    "id": 756,
    "name": "DS 4",
    "slug": "ds-4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:22:36",
    "parent_name": "Citroen"
  },
  {
    "id": 757,
    "name": "Jumper",
    "slug": "jumper",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:22:49",
    "parent_name": "Citroen"
  },
  {
    "id": 758,
    "name": "Xsara Picasso",
    "slug": "xsara-picasso",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:23:04",
    "parent_name": "Citroen"
  },
  {
    "id": 759,
    "name": "Other",
    "slug": "other-53",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "68",
    "created_at": "2019-08-08 13:23:58",
    "parent_name": "Citroen"
  },
  {
    "id": 761,
    "name": "DLX",
    "slug": "dlx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "69",
    "created_at": "2019-08-08 13:24:54",
    "parent_name": "Jinbei"
  },
  {
    "id": 762,
    "name": "Cargo Van",
    "slug": "cargo-van",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "69",
    "created_at": "2019-08-08 13:25:37",
    "parent_name": "Jinbei"
  },
  {
    "id": 763,
    "name": "H2L Highroof",
    "slug": "h2l-highroof",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "69",
    "created_at": "2019-08-08 13:48:19",
    "parent_name": "Jinbei"
  },
  {
    "id": 764,
    "name": "280ZX ",
    "slug": "280zx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:54:46",
    "parent_name": "Nissan"
  },
  {
    "id": 765,
    "name": "300ZX ",
    "slug": "300zx",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:55:04",
    "parent_name": "Nissan"
  },
  {
    "id": 766,
    "name": "350Z ",
    "slug": "350z",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:55:27",
    "parent_name": "Nissan"
  },
  {
    "id": 767,
    "name": "370z ",
    "slug": "370z",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:55:40",
    "parent_name": "Nissan"
  },
  {
    "id": 768,
    "name": "Altima ",
    "slug": "altima",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:55:52",
    "parent_name": "Nissan"
  },
  {
    "id": 769,
    "name": "Armada ",
    "slug": "armada",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:56:15",
    "parent_name": "Nissan"
  },
  {
    "id": 770,
    "name": "GT-R ‬ ‫",
    "slug": "gt-r",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:56:27",
    "parent_name": "Nissan"
  },
  {
    "id": 771,
    "name": "Juke ",
    "slug": "juke",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:56:41",
    "parent_name": "Nissan"
  },
  {
    "id": 772,
    "name": "Kicks ",
    "slug": "kicks",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:56:57",
    "parent_name": "Nissan"
  },
  {
    "id": 773,
    "name": "Maxima ",
    "slug": "maxima",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:57:29",
    "parent_name": "Nissan"
  },
  {
    "id": 774,
    "name": "Micra ",
    "slug": "micra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:57:45",
    "parent_name": "Nissan"
  },
  {
    "id": 775,
    "name": "Murano ",
    "slug": "murano",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:57:59",
    "parent_name": "Nissan"
  },
  {
    "id": 776,
    "name": "Navara ",
    "slug": "navara",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:58:13",
    "parent_name": "Nissan"
  },
  {
    "id": 777,
    "name": "Pathfinder ",
    "slug": "pathfinder",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:58:25",
    "parent_name": "Nissan"
  },
  {
    "id": 778,
    "name": "Patrol ",
    "slug": "patrol",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:58:43",
    "parent_name": "Nissan"
  },
  {
    "id": 779,
    "name": "Patrol Pickup ",
    "slug": "patrol-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:58:55",
    "parent_name": "Nissan"
  },
  {
    "id": 780,
    "name": "Pickup ",
    "slug": "pickup-15",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 13:59:22",
    "parent_name": "Nissan"
  },
  {
    "id": 781,
    "name": "Qashqai ",
    "slug": "qashqai",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:00:12",
    "parent_name": "Nissan"
  },
  {
    "id": 782,
    "name": "Rogue ",
    "slug": "rogue",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:00:36",
    "parent_name": "Nissan"
  },
  {
    "id": 783,
    "name": "Silvia ",
    "slug": "silvia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:01:10",
    "parent_name": "Nissan"
  },
  {
    "id": 784,
    "name": "Skyline ",
    "slug": "skyline",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:01:23",
    "parent_name": "Nissan"
  },
  {
    "id": 785,
    "name": "Sunny ",
    "slug": "sunny",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:01:35",
    "parent_name": "Nissan"
  },
  {
    "id": 786,
    "name": "Terrano ",
    "slug": "terrano",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:02:21",
    "parent_name": "Nissan"
  },
  {
    "id": 787,
    "name": "Tiida ",
    "slug": "tiida",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:02:34",
    "parent_name": "Nissan"
  },
  {
    "id": 788,
    "name": "Titan ",
    "slug": "titan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:02:48",
    "parent_name": "Nissan"
  },
  {
    "id": 789,
    "name": "Van ",
    "slug": "van-16",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:03:00",
    "parent_name": "Nissan"
  },
  {
    "id": 790,
    "name": "X-Trail ",
    "slug": "x-trail",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:03:12",
    "parent_name": "Nissan"
  },
  {
    "id": 791,
    "name": "Xterra ",
    "slug": "xterra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:03:25",
    "parent_name": "Nissan"
  },
  {
    "id": 792,
    "name": "Other ",
    "slug": "other-54",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "70",
    "created_at": "2019-08-08 14:03:37",
    "parent_name": "Nissan"
  },
  {
    "id": 793,
    "name": "C-Class ‬ ",
    "slug": "c-class-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:04:10",
    "parent_name": "Volvo"
  },
  {
    "id": 794,
    "name": "S-Class ‬ ",
    "slug": "s-class-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:05:41",
    "parent_name": "Volvo"
  },
  {
    "id": 795,
    "name": "V-Class ",
    "slug": "v-class",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:05:51",
    "parent_name": "Volvo"
  },
  {
    "id": 796,
    "name": "XC40 ",
    "slug": "xc40",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:06:07",
    "parent_name": "Volvo"
  },
  {
    "id": 797,
    "name": "XC60 ",
    "slug": "xc60",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:06:22",
    "parent_name": "Volvo"
  },
  {
    "id": 798,
    "name": "XC70 ",
    "slug": "xc70",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:06:36",
    "parent_name": "Volvo"
  },
  {
    "id": 799,
    "name": "XC90 ",
    "slug": "xc90",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:06:49",
    "parent_name": "Volvo"
  },
  {
    "id": 800,
    "name": "Other ",
    "slug": "other-55",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "71",
    "created_at": "2019-08-08 14:07:04",
    "parent_name": "Volvo"
  },
  {
    "id": 801,
    "name": "Lanos",
    "slug": "lanos",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:10:16",
    "parent_name": "Daewoo"
  },
  {
    "id": 802,
    "name": "Leganza",
    "slug": "leganza",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:10:32",
    "parent_name": "Daewoo"
  },
  {
    "id": 803,
    "name": "Matiz",
    "slug": "matiz",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:10:46",
    "parent_name": "Daewoo"
  },
  {
    "id": 804,
    "name": "Musso ",
    "slug": "musso",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:11:02",
    "parent_name": "Daewoo"
  },
  {
    "id": 805,
    "name": "Nubira",
    "slug": "nubira",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:11:16",
    "parent_name": "Daewoo"
  },
  {
    "id": 806,
    "name": "Other",
    "slug": "other-56",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "72",
    "created_at": "2019-08-08 14:11:29",
    "parent_name": "Daewoo"
  },
  {
    "id": 807,
    "name": "X-Bow",
    "slug": "x-bow",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "73",
    "created_at": "2019-08-08 14:15:07",
    "parent_name": "KTM"
  },
  {
    "id": 808,
    "name": "Astra",
    "slug": "astra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:16:24",
    "parent_name": "Opel"
  },
  {
    "id": 809,
    "name": "Cascada",
    "slug": "cascada",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:16:37",
    "parent_name": "Opel"
  },
  {
    "id": 810,
    "name": "Corsa",
    "slug": "corsa",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:16:52",
    "parent_name": "Opel"
  },
  {
    "id": 811,
    "name": "Insignia",
    "slug": "insignia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:17:58",
    "parent_name": "Opel"
  },
  {
    "id": 812,
    "name": "Kadett",
    "slug": "kadett",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:18:15",
    "parent_name": "Opel"
  },
  {
    "id": 813,
    "name": "Meriva",
    "slug": "meriva",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:18:34",
    "parent_name": "Opel"
  },
  {
    "id": 814,
    "name": "Mokka",
    "slug": "mokka",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:18:46",
    "parent_name": "Opel"
  },
  {
    "id": 815,
    "name": "Omega",
    "slug": "omega",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:18:59",
    "parent_name": "Opel"
  },
  {
    "id": 816,
    "name": "Signum",
    "slug": "signum",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:19:37",
    "parent_name": "Opel"
  },
  {
    "id": 817,
    "name": "Vectra",
    "slug": "vectra",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:19:51",
    "parent_name": "Opel"
  },
  {
    "id": 818,
    "name": "Vita",
    "slug": "vita-3",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:20:05",
    "parent_name": "Opel"
  },
  {
    "id": 819,
    "name": "Zafira",
    "slug": "zafira",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:20:38",
    "parent_name": "Opel"
  },
  {
    "id": 820,
    "name": "Zafira",
    "slug": "zafira-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:21:04",
    "parent_name": "Opel"
  },
  {
    "id": 821,
    "name": "Other",
    "slug": "other-57",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "74",
    "created_at": "2019-08-08 14:21:17",
    "parent_name": "Opel"
  },
  {
    "id": 822,
    "name": "Charade",
    "slug": "charade",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:21:56",
    "parent_name": "Daihatsu"
  },
  {
    "id": 823,
    "name": "Gran Max",
    "slug": "gran-max",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:22:09",
    "parent_name": "Daihatsu"
  },
  {
    "id": 824,
    "name": "Materia",
    "slug": "materia",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:22:22",
    "parent_name": "Daihatsu"
  },
  {
    "id": 825,
    "name": "Rocky",
    "slug": "rocky",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:22:37",
    "parent_name": "Daihatsu"
  },
  {
    "id": 826,
    "name": "Sirion",
    "slug": "sirion",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:22:49",
    "parent_name": "Daihatsu"
  },
  {
    "id": 827,
    "name": "Terios",
    "slug": "terios",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 14:23:38",
    "parent_name": "Daihatsu"
  },
  {
    "id": 828,
    "name": "YRV",
    "slug": "yrv",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 16:03:38",
    "parent_name": "Daihatsu"
  },
  {
    "id": 829,
    "name": "Other",
    "slug": "other-58",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "75",
    "created_at": "2019-08-08 16:03:53",
    "parent_name": "Daihatsu"
  },
  {
    "id": 830,
    "name": "Cadenza ",
    "slug": "cadenza",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:04:50",
    "parent_name": "Kia"
  },
  {
    "id": 831,
    "name": "Carens ",
    "slug": "carens",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:05:27",
    "parent_name": "Kia"
  },
  {
    "id": 832,
    "name": "Carnival ",
    "slug": "carnival",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:05:41",
    "parent_name": "Kia"
  },
  {
    "id": 833,
    "name": "Cerato ",
    "slug": "cerato",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:05:55",
    "parent_name": "Kia"
  },
  {
    "id": 834,
    "name": "Koup ",
    "slug": "koup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:06:10",
    "parent_name": "Kia"
  },
  {
    "id": 835,
    "name": "Mohave ",
    "slug": "mohave",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:06:29",
    "parent_name": "Kia"
  },
  {
    "id": 836,
    "name": "Oprius ",
    "slug": "oprius",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:06:42",
    "parent_name": "Kia"
  },
  {
    "id": 837,
    "name": "Optima ",
    "slug": "optima",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:07:01",
    "parent_name": "Kia"
  },
  {
    "id": 838,
    "name": "Picanto ",
    "slug": "picanto",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:07:15",
    "parent_name": "Kia"
  },
  {
    "id": 839,
    "name": "Quoris ",
    "slug": "quoris",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:07:30",
    "parent_name": "Kia"
  },
  {
    "id": 840,
    "name": "Rio ",
    "slug": "rio-11",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:07:43",
    "parent_name": "Kia"
  },
  {
    "id": 841,
    "name": "Sedona ",
    "slug": "sedona",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:07:56",
    "parent_name": "Kia"
  },
  {
    "id": 842,
    "name": "Sorento ",
    "slug": "sorento",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:08:24",
    "parent_name": "Kia"
  },
  {
    "id": 843,
    "name": "Soul ",
    "slug": "soul",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:08:47",
    "parent_name": "Kia"
  },
  {
    "id": 844,
    "name": "Sportage ",
    "slug": "sportage",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:09:00",
    "parent_name": "Kia"
  },
  {
    "id": 845,
    "name": "Stinger ",
    "slug": "stinger",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:09:18",
    "parent_name": "Kia"
  },
  {
    "id": 846,
    "name": "Other ",
    "slug": "other-59",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "76",
    "created_at": "2019-08-08 16:10:04",
    "parent_name": "Kia"
  },
  {
    "id": 847,
    "name": "Heavy Vehicles ‬ ‫",
    "slug": "heavy-vehicles-2",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:10:39",
    "parent_name": "Other Make"
  },
  {
    "id": 848,
    "name": "Other 4x4 ‬ ‫",
    "slug": "other-4x4",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:10:53",
    "parent_name": "Other Make"
  },
  {
    "id": 849,
    "name": "Other Car ‬ ",
    "slug": "other-car",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:11:07",
    "parent_name": "Other Make"
  },
  {
    "id": 850,
    "name": "Other Minivan ",
    "slug": "other-minivan",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:11:23",
    "parent_name": "Other Make"
  },
  {
    "id": 851,
    "name": "Other Pickup ‬ ‫",
    "slug": "other-pickup",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:12:01",
    "parent_name": "Other Make"
  },
  {
    "id": 852,
    "name": "Other Utility ‬ ‫",
    "slug": "other-utility",
    "category_id": "5",
    "sub_category_id": "6",
    "make_id": "77",
    "created_at": "2019-08-08 16:12:34"
  }
]';

		$data = (json_decode($data));

		self::$jsonManipulation->get_auto_incremental_id('models_incremental_id', (array) $data);
		foreach ($data as $model) {
			self::$jsonManipulation->add_model((array)$model);
		}
	}

	public function add_old_makes()
	{
		echo PHP_EOL . PHP_EOL . ' Already Done ' . PHP_EOL . PHP_EOL;
		exit();

		// REF: https://jsonformatter.org/json-parser
		// Copy from database and get the specific record (extract record) by using above url and then try to add makes into database.


		$data = '[
  {
    "id": 1,
    "name": "Audi",
    "slug": "audi",
    "created_at": "2019-08-05 16:51:06",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 2,
    "name": "Acura",
    "slug": "acura",
    "created_at": "2019-08-05 17:00:53",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 4,
    "name": "Peugeot",
    "slug": "peugeot",
    "created_at": "2019-08-05 17:03:55",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 5,
    "name": "Alfa Romeo",
    "slug": "alfa-romeo",
    "created_at": "2019-08-05 17:08:49",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 6,
    "name": "Lamborghini",
    "slug": "lamborghini",
    "created_at": "2019-08-05 17:35:18",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 7,
    "name": "Aston Marti",
    "slug": "aston-marti",
    "created_at": "2019-08-05 17:37:39",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 8,
    "name": "Dodge",
    "slug": "dodge",
    "created_at": "2019-08-05 17:42:01",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 9,
    "name": "Land Rover",
    "slug": "land-rover",
    "created_at": "2019-08-05 17:49:31",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 10,
    "name": "Porsche",
    "slug": "porsche",
    "created_at": "2019-08-05 17:52:18",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 11,
    "name": "Ferrari",
    "slug": "ferrari",
    "created_at": "2019-08-05 17:58:18",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 12,
    "name": "Lexus",
    "slug": "lexus",
    "created_at": "2019-08-05 18:03:25",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 13,
    "name": "BAIC",
    "slug": "baic",
    "created_at": "2019-08-05 18:07:03",
    "category_id": "5",
    "parent_name": "Autos",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars"
  },
  {
    "id": 14,
    "name": "Fiat",
    "slug": "fiat",
    "created_at": "2019-08-05 18:08:33",
    "category_id": "5",
    "sub_category_id": "6",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 15,
    "name": "Lincoln ",
    "slug": "lincoln",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 15:58:54",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 16,
    "name": "Renault",
    "slug": "renault",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:01:05",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 17,
    "name": "BMW",
    "slug": "bmw",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:04:54",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 18,
    "name": "Fisker",
    "slug": "fisker",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:09:27",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 19,
    "name": "Lotus",
    "slug": "lotus",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:10:01",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 20,
    "name": "Rolls Royce",
    "slug": "rolls-royce",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:12:16",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 21,
    "name": "Bentley",
    "slug": "bentley",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:13:35",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 22,
    "name": "Ford",
    "slug": "ford",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:20:15",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 23,
    "name": "Luxgen",
    "slug": "luxgen",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:28:01",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 24,
    "name": "Rover",
    "slug": "rover-4",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:29:13",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 25,
    "name": "Borgward",
    "slug": "borgward",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:29:43",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 26,
    "name": "GMC",
    "slug": "gmc",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:32:08",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 27,
    "name": "MG",
    "slug": "mg",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:34:24",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 28,
    "name": "Saab",
    "slug": "saab",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:38:08",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 29,
    "name": "Brilliance",
    "slug": "brilliance",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:55:11",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 30,
    "name": "Geely",
    "slug": "geely",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 16:55:47",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 31,
    "name": "MINI",
    "slug": "mini-2",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 17:01:13",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 32,
    "name": "Seat",
    "slug": "seat",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-06 17:03:30",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 33,
    "name": "Gumpert",
    "slug": "gumpert",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 14:44:44",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 34,
    "name": "Mahindra",
    "slug": "mahindra",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 14:45:15",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 35,
    "name": "Bugatti",
    "slug": "bugatti",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 14:46:46",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 36,
    "name": "Honda",
    "slug": "honda",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 14:48:22",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 37,
    "name": "Maserati",
    "slug": "maserati",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 14:53:16",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 38,
    "name": "Skoda",
    "slug": "skoda",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 15:00:10",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 39,
    "name": "Hummer",
    "slug": "hummer",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 15:01:03",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 40,
    "name": "Maxus",
    "slug": "maxus",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 15:02:24",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 41,
    "name": "CMC",
    "slug": "cmc",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 15:03:26",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 42,
    "name": "Hyundai",
    "slug": "hyundai",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 15:03:59",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 43,
    "name": "Maybach",
    "slug": "maybach",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 16:54:43",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 44,
    "name": "Subaru",
    "slug": "subaru",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 16:55:47",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 45,
    "name": "Cadillac",
    "slug": "cadillac",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 16:58:05",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 46,
    "name": "Infiniti",
    "slug": "infiniti",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 17:15:43",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 47,
    "name": "Mazda",
    "slug": "mazda",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 17:36:28",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 48,
    "name": "Suzuki",
    "slug": "suzuki",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 17:41:58",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 49,
    "name": "Isuzu",
    "slug": "isuzu",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 17:49:58",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 50,
    "name": "McLaren",
    "slug": "mclaren",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 18:00:26",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 51,
    "name": "TATA",
    "slug": "tata",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 18:02:56",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 52,
    "name": "Changan",
    "slug": "changan",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 18:03:54",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 53,
    "name": "JAC",
    "slug": "jac",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-07 18:05:06",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 54,
    "name": "Mercedes-Benz",
    "slug": "mercedes-benz",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:10:27",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 55,
    "name": "Tesla",
    "slug": "tesla",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:27:09",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 56,
    "name": "Chery",
    "slug": "chery",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:28:21",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 57,
    "name": "JMC",
    "slug": "jmc",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:29:59",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 58,
    "name": "Mercury",
    "slug": "mercury",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:32:57",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 59,
    "name": "Toyota",
    "slug": "toyota",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:35:29",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 60,
    "name": "Chevrolet",
    "slug": "chevrolet",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:43:38",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 61,
    "name": "Jaguar",
    "slug": "jaguar",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:50:44",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 62,
    "name": "Mitsubishi",
    "slug": "mitsubishi",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 12:55:02",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 63,
    "name": "UAZ",
    "slug": "uaz",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:00:24",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 64,
    "name": "Chrysler",
    "slug": "chrysler",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:02:11",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 65,
    "name": "Jeep",
    "slug": "jeep",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:05:09",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 66,
    "name": "Morgan",
    "slug": "morgan",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:10:27",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 67,
    "name": "Volkswagen",
    "slug": "volkswagen",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:13:13",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 68,
    "name": "Citroen",
    "slug": "citroen",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:18:23",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 69,
    "name": "Jinbei",
    "slug": "jinbei",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:24:14",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 70,
    "name": "Nissan",
    "slug": "nissan",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 13:48:29",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 71,
    "name": "Volvo",
    "slug": "volvo",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 14:03:52",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 72,
    "name": "Daewoo",
    "slug": "daewoo",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 14:09:47",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 73,
    "name": "KTM",
    "slug": "ktm",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 14:14:38",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 74,
    "name": "Opel",
    "slug": "opel",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 14:15:19",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 75,
    "name": "Daihatsu",
    "slug": "daihatsu",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 14:21:30",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 76,
    "name": "Kia",
    "slug": "kia",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 16:04:03",
    "sub_category_name": "Used Cars",
    "parent_name": "Autos"
  },
  {
    "id": 77,
    "name": "Other Make",
    "slug": "other-make",
    "category_id": "5",
    "sub_category_id": "6",
    "created_at": "2019-08-08 16:10:13"
  }
]';

		$data = (json_decode($data));

		self::$jsonManipulation->get_auto_incremental_id('makes_incremental_id', (array) $data);
		foreach ($data as $make) {
			self::$jsonManipulation->add_make((array)$make);
		}
	}

	public function old_cats()
	{
		echo PHP_EOL . PHP_EOL . ' Already Done ' . PHP_EOL . PHP_EOL;
		exit();

		$cats = $this->db->select('*')->from('categories')->get()->result_object();

		foreach ($cats as $i => $cat) {
			$cats[$i]->type_of_image_icon = '';
			$cats[$i]->image_icon_mobile = '';
		}

		self::$jsonManipulation->get_auto_incremental_id('categories_incremental_id', (array) $cats);
		foreach ($cats as $cat) {
			self::$jsonManipulation->add_category((array)$cat);
		}
	}

	/* ================================================================================================================	*/
	/* 										Categories Logic								*/
	/* ================================================================================================================	*/

	public function index()
	{
		$data = array(
			'all_cats' => self::$jsonManipulation->get_categories(false),
			'validation_errors' => validation_errors(),
			'success_msg' => ''
		);
		$this->load->view('admin/categories/show_all', $data);
	}

	public function add()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!empty($posted_data)) {

			$slug = volgo_make_slug($posted_data['cat_title']);

			// 1) Creating Slug
			$slug = self::$jsonManipulation->check_slug($slug);

			// 2) upload category desktop image
			if (!empty($_FILES['cat_image_desktop']['name'])) {
				//$config['upload_path'] = './uploads/categories';
				$config['upload_path'] = FRONT_END_UPLOADS_URL . './categories';
                $config['allowed_types'] = 'gif|jpg|png';


				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image_desktop')) {
					$data = array(
						'all_cats' => $this->Categories_Model->get_cats()
					);
					$unable_to_upload = true;

					$this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Unable to upload category image for desktop.<br />Possible Reasons:<br />' . $this->upload->display_errors());

					redirect('categories', $data);
				} else {
					$upload_img_data_desktop = $this->upload->data();
				}
			}

			// 3) upload category mobile image
			if (!empty($_FILES['cat_image_mobile']['name'])) {
				$config['upload_path'] = FRONT_END_UPLOADS_URL . './categories';
				$config['allowed_types'] = 'gif|jpg|png';


				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image_mobile')) {
					$data = array(
						'all_cats' => $this->Categories_Model->get_cats()
					);
					$unable_to_upload = true;
					$this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Unable to upload category image for mobile.<br />Possible Reasons:<br />' . $this->upload->display_errors());

					redirect('categories', $data);
				} else {
					$upload_img_data_mobile = $this->upload->data();
				}
			}


			// 4) some house keeping
			if (isset($unable_to_upload))
				return;

			if (isset($upload_img_data_desktop)) {
				$cat_image_desktop = $upload_img_data_desktop["file_name"];
			} else {
				$cat_image_desktop = $this->input->post('cat_icon');
			}

			if (isset($upload_img_data_mobile)) {
				$cat_image_mobile = $upload_img_data_mobile["file_name"];
			} else {
				$cat_image_mobile = $this->input->post('cat_icon_mobile');
			}

			// 5) validations
			$this->form_validation->set_rules('cat_title', 'Category Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_desc', 'Category Description', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_slug', 'Category Slug', 'required|min_length[1]');
			$this->form_validation->set_rules('category_type', 'Category Type', 'required|min_length[1]');

			if ($this->form_validation->run() !== FALSE) {
				$categories = self::$jsonManipulation->get_categories();
				$id = self::$jsonManipulation->get_auto_incremental_id('categories_incremental_id', $categories);
                $parent_id = (isset($posted_data['selected_sub_category']) && $posted_data['selected_sub_category'] !== NULL) ? $posted_data['selected_sub_category'] : $posted_data['parent_cat'];
				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['cat_title'],
					'slug' => $slug,
					'type' => $posted_data['image_icon'],
					'image_icon' => $cat_image_desktop,
					'type_of_image_icon' => $posted_data['image_icon_mobile'],
					'image_icon_mobile' => $cat_image_mobile,
					'parent_ids' => (isset($parent_id) && $parent_id !== NULL) ? $parent_id : 'uncategorised',
					'description' => $posted_data['cat_desc'],
					'category_type' => $posted_data['category_type'],
					'created_at' => date("Y-m-d H:i:s"),
				];
                
        $cat_parent = (isset($parent_id) && $parent_id !== NULL) ? $parent_id : 'uncategorised';
				// adding into json and then to database
				self::$jsonManipulation->add_category($arr);
        $this->Category_Model->create_category($posted_data['cat_title'], $cat_image_desktop, $cat_parent, $posted_data['cat_desc'], $posted_data['image_icon'], $posted_data['category_type'], $slug);
				$this->session->set_flashdata('success_msg', 'Category Successfully added');

				redirect(base_url('categories'));
			} else {

				$this->session->set_flashdata('validation_errors', validation_errors());

				redirect(base_url('categories'));
			}
		} else {

			$this->load->view('admin/categories/show_all');
		}
	}

	public function edit($id)
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! empty($posted_data)){

			// 1) upload category desktop image
			if (!empty($_FILES['cat_image_desktop']['name'])) {
				$config['upload_path'] = FRONT_END_UPLOADS_URL . '/categories';
				$config['allowed_types'] = 'gif|jpg|png';


				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image_desktop')) {
					$data = array(
						'all_cats' => self::$jsonManipulation->get_categories(false)
					);
					$unable_to_upload = true;

					$this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Unable to upload category image for desktop.<br />Possible Reasons:<br />' . $this->upload->display_errors());

					redirect(base_url('categories/edit/' . $id));
				} else {
					$upload_img_data_desktop = $this->upload->data();
				}
			}

			// 2) upload category mobile image
			if (!empty($_FILES['cat_image_mobile']['name'])) {
				$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/categories/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
                echo "<pre>";print_r($config);die;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('cat_image_mobile')) {
					$data = array(
						'all_cats' => self::$jsonManipulation->get_categories(false)
					);
					$unable_to_upload = true;
					$this->session->set_flashdata('validation_errors', '<strong>Sorry!</strong><br />' . 'Unable to upload category image for mobile.<br />Possible Reasons:<br />' . $this->upload->display_errors());

					redirect(base_url('categories/edit/' . $id));
				} else {
					$upload_img_data_mobile = $this->upload->data();
				}
			}


			// 3) some house keeping
			if (isset($unable_to_upload))
				return;

			if (isset($upload_img_data_desktop)) {
				$cat_image_desktop = $upload_img_data_desktop["file_name"];
			} else {
				$cat_image_desktop = $this->input->post('cat_icon');
			}

			if (isset($upload_img_data_mobile)) {
				$cat_image_mobile = $upload_img_data_mobile["file_name"];
			} else {
				$cat_image_mobile = $this->input->post('cat_icon_mobile');
			}

			// 4) validations
			$this->form_validation->set_rules('cat_title', 'Category Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_desc', 'Category Description', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('cat_slug', 'Category Slug', 'required|min_length[1]');
			$this->form_validation->set_rules('category_type', 'Category Type', 'required|min_length[1]');

			if ($this->form_validation->run() !== FALSE) {
				$categories = self::$jsonManipulation->get_categories();

				// 5) Removing category
				$old_cat_data = (object)[];
				$removed_index = 0;
				foreach ($categories as $index => $category) {
					if (intval($category->id) === intval($id)){
						$old_cat_data->mobile_image = $category->image_icon_mobile;
						$old_cat_data->desktop_image = $category->image_icon;

						$removed_index = $index;
						break;
					}
				}

				// 6) Creating Slug
				$slug = volgo_make_slug($posted_data['cat_title']);

				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['cat_title'],
					'slug' => $slug,
					'type' => $posted_data['image_icon'],
					'image_icon' => (empty($cat_image_desktop)) ? $old_cat_data->desktop_image : $cat_image_desktop,
					'type_of_image_icon' => $posted_data['image_icon_mobile'],
					'image_icon_mobile' => (empty($cat_image_mobile)) ? $old_cat_data->mobile_image : $cat_image_mobile,
					'parent_ids' => (isset($posted_data['parent_cat']) && $posted_data['parent_cat'] !== NULL) ? $posted_data['parent_cat'] : 'uncategorised',
					'description' => $posted_data['cat_desc'],
					'category_type' => $posted_data['category_type'],
					'created_at' => date("Y-m-d H:i:s"),
				];

				// Adding on the same location.
				$categories[$removed_index] = $arr;
				$categories = array_values($categories); // confirming that there is no broken index

				// adding into json and then to database
				self::$jsonManipulation->update_array_items($categories, 'categories');

				$this->session->set_flashdata('success_msg', 'Category Successfully Updated');

				redirect(base_url('categories/edit/' . $id));
			}else {

				$this->session->set_flashdata('validation_errors', validation_errors());

				redirect(base_url('categories/edit/' . $id));
			}
		}else {

			$data = [
				'category' => self::$jsonManipulation->get_single_record($id),
				'cat_slug' => self::$jsonManipulation->get_single_record($id, 'slug'),
				'all_cats' => self::$jsonManipulation->get_categories(null)
			];
			$this->load->view('admin/categories/edit', $data);
		}

	}

	// Edit Make
	public function edit_make($id)
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! empty($posted_data)){
			
			// 1) validations
			$this->form_validation->set_rules('make_title', 'Make Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('make_slug', 'Make Slug', 'required|min_length[1]');
			$this->form_validation->set_rules('category', 'Category Type', 'required|min_length[1]');
			$this->form_validation->set_rules('sub_category', 'Sub Category Type', 'required|min_length[1]');

			if ($this->form_validation->run() !== FALSE) {
				$makes = self::$jsonManipulation->get_makes();

				// 2) Removing make
				$old_cat_data = (object)[];
				$removed_index = 0;
				foreach ($makes as $index => $make) {
					if (intval($make->id) === intval($id)){
						
						$removed_index = $index;
						break;
					}
				}

				// 3) Creating Slug
				$slug = volgo_make_slug($posted_data['make_title']);
				$slug = self::$jsonManipulation->check_slug($slug);

				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['make_title'],
					'slug' => $slug,
					'category_id' => $posted_data['category'],
					'sub_category_id' => $posted_data['sub_category'],
					'created_at' => date("Y-m-d H:i:s"),
				];
				
				// Adding on the same location.
				$makes[$removed_index] = $arr;
				$makes = array_values($makes); // confirming that there is no broken index

				// adding into json and then to database
				self::$jsonManipulation->update_array_items($makes, 'makes');
				
				$this->session->set_flashdata('success_msg', 'Category Successfully Updated');

				redirect(base_url('categories/edit_make/' . $id));
			}else {
				
				redirect(base_url('categories/edit_make/' . $id));
			}
		}else {

			$data = [
				'all_makes' => self::$jsonManipulation->get_makes(),
				'make' => self::$jsonManipulation->get_single_record($id,null,'makes'),
			    'all_cats'  => self::$jsonManipulation->get_categories()
			];
			
			$this->load->view('admin/categories/makes/edit_make', $data);
		}

	}

	// Edit Model
	public function edit_model($id)
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! empty($posted_data)){
			
			// 1) validations
			$this->form_validation->set_rules('model_title', 'Model Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('model_slug', 'Model Slug', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('category', 'Category', 'required|min_length[1]');
			$this->form_validation->set_rules('sub_category', 'Sub Category', 'required|min_length[1]');
			$this->form_validation->set_rules('select_make', 'Make', 'required|min_length[1]');

			if ($this->form_validation->run() !== FALSE) {
				
				$models = self::$jsonManipulation->get_models();
				// 2) Removing model
				$old_cat_data = (object)[];
				$removed_index = 0;
				foreach ($models as $index => $model) {
					if (intval($model->id) === intval($id)){

						$removed_index = $index;
						break;
					}
				}

				// 3) Creating Slug
				$slug = volgo_make_slug($posted_data['model_title']);
				$slug = self::$jsonManipulation->check_slug($slug);

				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['model_title'],
					'slug' => $slug,
					'category_id' => $posted_data['category'],
					'sub_category_id' => $posted_data['sub_category'],
					'make_id' => $posted_data['select_make'],
					'created_at' => date("Y-m-d H:i:s"),
				];

				
				// Adding on the same location.
				$models[$removed_index] = $arr;
				$models = array_values($models); // confirming that there is no broken index

				// adding into json and then to database
				self::$jsonManipulation->update_array_items($models, 'models');
				
				$this->session->set_flashdata('success_msg', 'Category Successfully Updated');

				redirect(base_url('categories/edit_model/' . $id));
			}else {

				redirect(base_url('categories/edit_model/' . $id));
			}
		}else {

			$data = [
				'model' => self::$jsonManipulation->get_single_record($id,null,'models'),
			    'all_makes' => self::$jsonManipulation->get_makes(),
			    'all_models' => self::$jsonManipulation->get_models(),
			    'all_cats' => self::$jsonManipulation->get_categories()
			];
			
			$this->load->view('admin/categories/models/edit_model', $data);
		}

	}

	public function remove($id)
	{
		$id = intval($id);
		if ($id < 1) {
			$this->session->set_flashdata('validation_errors', 'Some internal Problem exists.Please try again.');
			redirect(base_url('categories'));
		}

		$categories = self::$jsonManipulation->get_categories();
		$makes = self::$jsonManipulation->get_makes();
		$models = self::$jsonManipulation->get_models();

		$deleted_cat_id = 0;
		$deleted_sub_cat_id = [];
		$deleted_make_id = [];

		// Deleting Category
		foreach ($categories as $index => $category) {
			if (intval($category->id) === $id) {
				// Removing actual category that is requested to remove.
				if ($category->parent_ids !== 'uncategorised') {
					// this is child category
					$deleted_cat_id = $deleted_sub_cat_id [] = $category->id;
				} else {
					$deleted_cat_id = $category->id;
				}

				unset($categories[$index]);
				break;
			}
		}

		// Deleting Sub Categories - Also removing childs if this is parent.
		foreach ($categories as $i => $sc) {
			if (intval($sc->parent_ids) === intval($deleted_cat_id)) {

				$deleted_sub_cat_id[] = $sc->id;
				unset($categories[$i]);
			}
		}

		// Deleting Makes
		if (! empty($deleted_sub_cat_id)) {
			$key = 'sub_category_id';
		} else {
			$key = 'category_id';
		}

		foreach ($makes as $index => $make) {

			if ($key === 'sub_category_id' && in_array($make->sub_category_id, $deleted_sub_cat_id)){
				$deleted_make_id[] = $make->id;
				unset($makes[$index]);
			}else if ( in_array($make->sub_category_id, $deleted_sub_cat_id)) {
				$deleted_make_id[] = $make->id;
				unset($makes[$index]);
			}
		}

		// Deleting Models
		foreach ($models as $index => $model) {
			if (in_array($model->make_id, $deleted_make_id)) {
				unset($models[$index]);
			}
		}

		// Updating DB.
		self::$jsonManipulation->update_array_items($categories, 'categories');
		self::$jsonManipulation->update_array_items($makes, 'makes');
		self::$jsonManipulation->update_array_items($models, 'models');

		$this->session->set_flashdata('removed', 'success');
		redirect(base_url('categories'));

	}

	/* ================================================================================================================	*/
	/* 										Makes Logic								*/
	/* ================================================================================================================	*/

	public function makes()
	{
		$data = array(
			'all_makes' => self::$jsonManipulation->get_makes(),
			'all_cats' => self::$jsonManipulation->get_categories(),
			'validation_errors' => validation_errors(),
			'success_msg' => ''
		);
		$this->load->view('admin/categories/makes/show_all', $data);
	}

	public function add_make()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!empty($posted_data)) {

			$this->form_validation->set_rules('make_title', 'Make Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('make_slug', 'Make Slug', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('category', 'Category', 'required|min_length[1]');
			$this->form_validation->set_rules('sub_category', 'Category', 'required|min_length[1]');


			if ($this->form_validation->run() !== FALSE) {


				// 1) Creating Slug
				$slug = volgo_make_slug($posted_data['make_title']);
				$slug = self::$jsonManipulation->check_slug($slug);

				$makes = self::$jsonManipulation->get_makes();

				$makes = isset($makes->data) ? $makes->data : [];

				$id = self::$jsonManipulation->get_auto_incremental_id('makes_incremental_id', (array) $makes);

				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['make_title'],
					'slug' => $slug,
					'category_id' => $posted_data['category'],
					'sub_category_id' => $posted_data['sub_category'],
					'created_at' => date("Y-m-d H:i:s"),
				];

				// adding into json and then to database
				self::$jsonManipulation->add_make($arr);

				$this->session->set_flashdata('success_msg', 'Make Successfully added');

				redirect(base_url('categories/makes'));
			} else {

				$this->session->set_flashdata('validation_errors', validation_errors());

				redirect(base_url('categories/makes'));
			}

		} else {
			redirect(base_url('categories/makes'));
		}
	}

	public function remove_make($id)
	{
		$id = intval($id);
		if ($id < 1) {
			$this->session->set_flashdata('validation_errors', 'Some internal Problem exists.Please try again.');
			redirect(base_url('categories/makes'));
		}

		$makes = self::$jsonManipulation->get_makes();
		$models = self::$jsonManipulation->get_models();

		foreach ($makes as $index => $make) {
			if (intval($make->id) === $id) {

				// Also removing childs if this is parent.
				foreach ($models as $i => $m) {
					if (intval($m->make_id) === $id) {
						unset($models[$i]);
					}
				}

				// Removing actual category that is requested to remove.
				unset($makes[$index]);
				break;
			}

		}

		// Updating DB.
		self::$jsonManipulation->update_array_items($makes, 'makes');
		self::$jsonManipulation->update_array_items($models, 'models');

		$this->session->set_flashdata('removed', 'success');
		redirect(base_url('categories/makes'));
	}

	/* ================================================================================================================	*/
	/* 										Models Logic								*/
	/* ================================================================================================================	*/

	public function models()
	{
		$data = array(
			'all_makes' => self::$jsonManipulation->get_makes(),
			'all_models' => self::$jsonManipulation->get_models(),
			'all_cats' => self::$jsonManipulation->get_categories(),
			'validation_errors' => validation_errors(),
			'success_msg' => ''
		);
		$this->load->view('admin/categories/models/show_all', $data);
	}

	public function add_model()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (!empty($posted_data)) {

			$this->form_validation->set_rules('model_title', 'Model Title', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('model_slug', 'Model Slug', 'min_length[1]|max_length[255]');
			$this->form_validation->set_rules('category', 'Category', 'required|min_length[1]');
			$this->form_validation->set_rules('sub_category', 'Sub Category', 'required|min_length[1]');
			$this->form_validation->set_rules('select_make', 'Make', 'required|min_length[1]');

			if ($this->form_validation->run() !== FALSE) {

				// 1) Creating Slug
				$slug = volgo_make_slug($posted_data['model_title']);
				$slug = self::$jsonManipulation->check_slug($slug);

				$models = self::$jsonManipulation->get_models();
				$id = self::$jsonManipulation->get_auto_incremental_id('models_incremental_id', (array)$models);

				// Actual array from where the game starts.
				$arr = [
					'id' => $id,
					'name' => $posted_data['model_title'],
					'slug' => $slug,
					'category_id' => $posted_data['category'],
					'sub_category_id' => $posted_data['sub_category'],
					'make_id' => $posted_data['select_make'],
					'created_at' => date("Y-m-d H:i:s"),
				];

				// adding into json and then to database
				self::$jsonManipulation->add_model($arr);

				$this->session->set_flashdata('success_msg', 'Model Successfully added');

				redirect(base_url('categories/models'));
			} else {

				$this->session->set_flashdata('validation_errors', validation_errors());

				redirect(base_url('categories/models'));
			}

		} else {
			redirect(base_url('categories/models'));
		}
	}

	public function remove_model($id)
	{
		$id = intval($id);
		if ($id < 1) {
			$this->session->set_flashdata('validation_errors', 'Some internal Problem exists.Please try again.');
			redirect(base_url('categories/models'));
		}
		$models = self::$jsonManipulation->get_models();

		foreach ($models as $i => $m) {
			if (intval($m->id) === $id) {
				unset($models[$i]);
				break;
			}
		}

		// Updating DB.
		self::$jsonManipulation->update_array_items($models, 'models');

		$this->session->set_flashdata('removed', 'success');
		redirect(base_url('categories/models'));
	}


	/* ================================================================================================================	*/
	/* 										Dynamic Forms Logic								*/
	/* ================================================================================================================	*/


	public function dynamic_forms()
	{
		$data = [
			'all_cats' => self::$jsonManipulation->get_categories(null),
			'dynamic_forms' => self::$jsonManipulation->get_dynamic_form()
		];

		// -- Available Old Keys --
		// advance_sidebar_search_form
		// homepage_category_form_search
		// basic_sidebar_search_form
		// form_category

		$this->load->view('admin/categories/dynamic-forms/show_all', $data);
	}

	public function add_form()
	{
		$posted_data = filter_input_array(INPUT_POST);

		if (! empty($posted_data)){

			$this->form_validation->set_rules('sub_category', 'Sub Category', 'required|min_length[1]|max_length[255]');
			$this->form_validation->set_rules('category', 'Category', 'required|min_length[1]|max_length[255]');

			if ($this->form_validation->run() !== false) {
				$form_code = $this->input->post('formcode');
				$form_code = str_replace(PHP_EOL, '', $form_code);

				$adv_form_code = $this->input->post('advance_formcode');
				$adv_form_code = str_replace(PHP_EOL, '', $adv_form_code);

				$basic_form_code = $this->input->post('basic_formcode');
				$basic_form_code = str_replace(PHP_EOL, '', $basic_form_code);

				$formcode_homepage = $this->input->post('formcode_homepage');
				$formcode_homepage = str_replace(PHP_EOL, '', $formcode_homepage);

				$parent_id = $this->input->post('category');
				$child_id = $this->input->post('sub_category');

				// -- Available Old Keys --
				// advance_sidebar_search_form
				// homepage_category_form_search
				// basic_sidebar_search_form
				// form_category

				$arr = [
					'parent_cat_id' => $parent_id,
					'child_cat_id' => $child_id,
					'forms' => [
						'advance_sidebar_search_form' => ($adv_form_code),
						'homepage_category_form_search' => ($formcode_homepage),
						'basic_sidebar_search_form' => ($basic_form_code),
						'form_category' => $form_code,
					]
				];

				self::$jsonManipulation->add_update_dynamic_forms($arr);

				$this->session->set_flashdata('success_msg', 'Dynamic form is successfully created/Updated !');
				redirect(base_url('categories/dynamic_forms'));

			}else {
				$this->session->set_flashdata('validation_errors', validation_errors());
				redirect(base_url('categories/dynamic_forms'));
			}
		}else{
			$data = [
				'all_cats' => self::$jsonManipulation->get_categories(),
				'dynamic_forms' => self::$jsonManipulation->get_dynamic_form()
			];

			$this->load->view('admin/categories/dynamic-forms/show_all', $data);
		}
	}
}
