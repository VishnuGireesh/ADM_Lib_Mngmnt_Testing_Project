package com.lib_testing;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.Assert;
import org.testng.annotations.AfterMethod;
import org.testng.annotations.BeforeMethod;
import org.testng.annotations.Test;

public class LogoutTest {

	WebDriver driver;

	@BeforeMethod
	public void setUp() {
		System.setProperty("webdriver.chrome.driver", ".\\drivers\\chromedriver.exe");
		driver = new ChromeDriver();
		driver.manage().timeouts().pageLoadTimeout(50, TimeUnit.SECONDS);
		driver.manage().timeouts().implicitlyWait(20, TimeUnit.SECONDS);
		driver.manage().window().maximize();
	}

	@Test
	public void Logout() {

		driver.get("http://localhost/Testing_library/project/student/login.php");

		driver.findElement(By.name("un")).sendKeys("sankar");
		driver.findElement(By.name("pass")).sendKeys("sankar");
		driver.findElement(By.name("sub")).click();
		
		//navigating to another page
		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//nav/ul[@class='nav navbar-nav navbar-right']/li[1]/a[@href='javascript:;']"))
				.click();

		driver.findElement(By.xpath(
				"/html/body[@class='nav-md']//nav/ul[@class='nav navbar-nav navbar-right']//ul[@class='dropdown-menu dropdown-usermenu pull-right']//a[@href='s_logout.php']"))
				.click();

		driver.get("http://localhost/Testing_library/project/student/my_issued_books.php");
		String at = driver.getTitle();
		String et = "student login";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(false);
		}

	}

	@AfterMethod
	public void tearDown() {
		driver.quit();
	}

	private void sleep(long m) {
		try {
			Thread.sleep(m);
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
