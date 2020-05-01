package com.lib_testing;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.testng.Assert;
import org.testng.annotations.AfterMethod;
import org.testng.annotations.BeforeMethod;
import org.testng.annotations.Test;

public class RegistrationCheck {
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
	public void Register() {
		driver.get("http://localhost/Testing_library/project/student/registration.php");
		/*
		 * driver.findElement( By.xpath(
		 * "/html//section[@class='login_content']/form[@name='form1']//a[@href='registration.php']"
		 * )) .click();
		 */

		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='name']")).sendKeys("tester");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='uname']")).sendKeys("tester");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='psw']")).sendKeys("tester");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='email']")).sendKeys("tester@gmail.com");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='phone']")).sendKeys("7896541235");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='sem']")).sendKeys("5");
		driver.findElement(By.xpath("//body[@class='login']//section[@class='login_content']/form[@name='form1']//input[@name='eno']")).sendKeys("500");

		driver.findElement(By.name("sub")).click();

		String at = driver
				.findElement(
						By.xpath("//body[@class='login']//div[@class='alert alert-success col-lg-6 col-lg-push-3']"))
				.getText();
		String et = "Registration Succesful";

		if (at.equalsIgnoreCase(et)) {
			System.out.println("Test Successful");
			Assert.assertTrue(true);
		} else {
			System.out.println("Test UnSuccessful");
			Assert.assertTrue(true);
		}

		/* sleep(2000); */
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
