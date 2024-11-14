<style>
:root {
  /* fonts */
  --font-montserrat: Montserrat;

  /* font sizes */
  --font-size-3xs: 10px;
  --font-size-xs: 12px;
  --font-size-xl: 20px;
  --font-size-lg: 18px;
  --font-size-5xs: 8px;

  /* Colors */
  --color-white: #fff;
  --color-darkslateblue-100: #5966b8;
  --color-darkslateblue-200: #343f92;
  --color-darkslateblue-300: #181e4e;
  --color-darkslateblue-400: rgba(24, 30, 78, 0.2);
  --color-darkslateblue-500: rgba(24, 30, 78, 0.18);
  --color-gainsboro: #e6e6e6;
  --color-black: #000;
  --color-ghostwhite: #eef0fd;
  --color-gold-100: #facc16;
  --color-gold-200: rgba(250, 204, 22, 0.24);
  --color-gray: #0b0b0b;
  --color-darkorange: #ff7700;
  --color-honeydew: #dff5e8;
  --color-aquamarine: #84e4ab;

  /* Gaps */
  --gap-5xs: 8px;
  --gap-8xs: 5px;
  --gap-4xs: 9px;
  --gap-smi: 13px;
  --gap-10xs: 3px;
  --gap-xl: 20px;
  --gap-8xl: 27px;
  --gap-9xs: 4px;
  --gap-12xs: 1px;

  /* Paddings */
  --padding-9xl: 28px;
  --padding-4xs: 9px;
  --padding-12xl: 31px;
  --padding-5xs: 8px;
  --padding-xl: 20px;
  --padding-mid: 17px;
  --padding-sm: 14px;
  --padding-54xl: 73px;
  --padding-4xl: 23px;
  --padding-10xs: 3px;
  --padding-9xs: 4px;
  --padding-19xl: 38px;
  --padding-11xs: 2px;
  --padding-8xs: 5px;
  --padding-base: 16px;
  --padding-lg: 18px;
  --padding-17xl: 36px;
  --padding-smi: 13px;
  --padding-7xs: 6px;
  --padding-12xs: 1px;
  --padding-6xs: 7px;
  --padding-3xs: 10px;

  /* Border radiuses */
  --br-mini: 15px;
  --br-7xs: 6px;
  --br-8xs: 5px;
  --br-xl: 20px;
}
    .digital-marketing-packages {
  margin: 0;
  /*position: relative;*/
  font-size: inherit;
  font-weight: 700;
  font-family: inherit;
}
.subscription-options-child,
.text-1-child {
  position: relative;
  border-radius: var(--br-8xs);
  display: none;
}
.subscription-options-child {
  height: 45px;
  width: 343px;
  border: 1px solid var(--color-darkslateblue-400);
  box-sizing: border-box;
  max-width: 100%;
}
.text-1-child {
  height: 39px;
  width: 76px;
  background-color: var(--color-ghostwhite);
}
.mo,.mo2,.mo4,.mo6{
    display:flex !important;
    align-items: center;
}
.month,
.monthly {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.monthly {
  font-weight: 500;
  min-width: 43px;
}
.month {
  min-width: 32px;
}
.month-wrapper {
  flex-direction: row;
  padding: 0 var(--padding-7xs) 0 var(--padding-8xs);
  font-size: var(--font-size-5xs);
}
.month-wrapper,
.monthly-plan-details,
.text-1 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.monthly-plan-details {
  flex-direction: column;
  gap: var(--gap-12xs);
}
.text-1 {
  /*border-radius: var(--br-8xs);*/
  /*background-color: var(--color-ghostwhite);*/
  flex-direction: row;
  padding: var(--padding-5xs) var(--padding-base);
  z-index: 1;
}
.month1,
.quarterly {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.quarterly {
  font-weight: 500;
  min-width: 48px;
}
.month1 {
  min-width: 34px;
}
.month-container {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 var(--padding-6xs);
  font-size: var(--font-size-5xs);
}
.quarterly-parent,
.subscription-options-inner {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.quarterly-parent {
  gap: var(--gap-12xs);
}
.subscription-options-inner {
  padding: var(--padding-5xs) var(--padding-3xs) 0 0;
}
.half-yearly,
.month2 {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.half-yearly {
  font-weight: 500;
  min-width: 54px;
}
.month2 {
  min-width: 34px;
}
.frame-div,
.half-yearly-parent,
.month-frame {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.month-frame {
  flex-direction: row;
  padding: 0 var(--padding-3xs);
  font-size: var(--font-size-5xs);
}
.frame-div,
.half-yearly-parent {
  flex-direction: column;
}
.half-yearly-parent {
  gap: var(--gap-12xs);
}
.frame-div {
  padding: var(--padding-5xs) var(--padding-base) 0 0;
}
.yearly {
  position: relative;
  font-weight: 500;
  display: inline-block;
  min-width: 31px;
  z-index: 1;
}
.yearly-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 var(--padding-10xs);
}
.month3 {
  position: relative;
  font-size: var(--font-size-5xs);
  display: inline-block;
  min-width: 37px;
  z-index: 1;
}
.frame-parent,
.yearly-plan-details {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent {
  gap: var(--gap-12xs);
}
.yearly-plan-details {
  padding: var(--padding-5xs) 0 0;
}
.subscription-options,
.subscription-options-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  box-sizing: border-box;
  max-width: 100%;
}
.subscription-options {
  margin: 0;
  width: 378px;
  border-radius: var(--br-8xs);
  border: 1px solid var(--color-darkslateblue-400);
  justify-content: space-between;
  padding: var(--padding-12xs) 24px var(--padding-12xs) var(--padding-10xs);
  gap: var(--gap-xl);
  white-space: nowrap;
  text-align: center;
  font-size: var(--font-size-3xs);
  color: var(--color-black);
  font-family: var(--font-montserrat);
}
.subscription-options-wrapper {
  align-self: stretch;
  justify-content: center;
  padding: 0 var(--padding-xl);
}
.digital-marketing-packages-p-parent {
  width: 561px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xl);
  max-width: 100%;
}
.macbook-air-1-inner {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: center;
  padding: 0 var(--padding-6xs) 0 0;
  max-width: 100%;
  text-align: left;
  font-size: 30px;
  color: var(--color-darkslateblue-300);
  font-family: var(--font-montserrat);
}
.border,
.cta:hover,
.macbook-air-1-inner {
  box-sizing: border-box;
}
.border {
  width: 265px;
  height: 430px;
  position: relative;
  filter: drop-shadow(0 4px 4px rgba(0, 0, 0, 0.25));
  border-radius: var(--br-mini);
  border: 1px solid var(--color-darkslateblue-500);
  display: none;
}
.bronze,
.div {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.bronze {
  margin: 0;
  font-size: inherit;
  font-weight: 600;
  font-family: inherit;
  min-width: 66px;
}
.div {
  min-width: 23.9px;
  white-space: nowrap;
}
.mothly-price-dividers {
  width: 26px;
  height: 1px;
  position: relative;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  z-index: 2;
  margin-top: -6px;
}
.frame-wrapper,
.parent {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.parent {
  flex: 1;
}
.frame-wrapper {
  height: 20px;
  padding: var(--padding-8xs) 0 0;
  box-sizing: border-box;
}
.span {
  font-weight: 600;
}
.mo1 {
  font-size: var(--font-size-xs);
  font-weight: 500;
  color: var(--color-black);
}
.mo {
  position: relative;
  display: inline-block;
  min-width: 78px;
  z-index: 1;
  font-size: var(--font-size-xl);
  color: var(--color-darkorange);
}
.off-button-child {
  height: 18px;
  width: 61px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  box-sizing: border-box;
  display: none;
}
.off {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 49px;
  z-index: 1;
}
.off-button,
.off-button-wrapper {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.off-button {
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  flex-direction: row;
  padding: 0 var(--padding-7xs);
  white-space: nowrap;
  z-index: 1;
}
.off-button-wrapper {
  flex-direction: column;
  padding: var(--padding-9xs) 0 0;
  color: var(--color-gray);
}
.frame-group {
  flex-direction: row;
  justify-content: flex-start;
  gap: var(--gap-5xs);
  font-size: var(--font-size-xs);
}
.box-bronze-inner,
.bronze-parent,
.frame-group {
  display: flex;
  align-items: flex-start;
}
.bronze-parent {
  flex-direction: column;
  justify-content: flex-start;
  gap: var(--gap-4xs);
}
.box-bronze-inner {
    flex-direction: row;
    /*justify-content: flex-end;*/
    justify-content: flex-start;
    /*padding: 0 var(--padding-17xl) var(--padding-smi) var(--padding-19xl);*/
    padding: 0 20px;
    width: 100%;
}
.frame-child {
  position: absolute;
  width: calc(100% - 18px);
  top: 0;
  right: 9px;
  left: 9px;
  border-radius: var(--br-8xs);
  background-color: var(--color-ghostwhite);
  height: 54px;
  z-index: 1;
}
.accumsan-vel-purus,
.ut-a-fringilla {
  margin: 0;
}
.accumsan-vel-purus-container {
  position: relative;
  top: 13px;
  left: 0;
  font-weight: 300;
  display: inline-block;
  /*width: 220px;*/
  height: 24px;
  z-index: 2;
  margin: 0 10px;
}
.rectangle-parent {
  align-self: stretch;
  height: 54px;
  position: relative;
  text-align: center;
  font-size: var(--font-size-3xs);
}
.ture-mark-01-icon {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.proin-vestibulum-lorem {
  position: relative;
  z-index: 1;
}
.frame-parent1 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon1 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-container {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-9xs) 0 0;
}
.variations-of-passages {
  position: relative;
  z-index: 1;
}
.frame-parent2 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon2 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-frame {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.contrary-to-popular {
  position: relative;
  z-index: 1;
}
.frame-parent3 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon3 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper1 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.excepteur-sint-occaecat {
  position: relative;
  z-index: 1;
}
.frame-parent4 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon4 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper2 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.nemo-enim-ipsam {
  position: relative;
  z-index: 1;
}
.frame-container,
.frame-parent5 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent5 {
  align-self: stretch;
  flex-direction: row;
  gap: var(--gap-8xs);
}
.frame-container {
  flex: 1;
  flex-direction: column;
  gap: var(--gap-5xs);
}
.box-bronze-child {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 var(--padding-xl) var(--padding-lg) var(--padding-4xl);
  font-size: var(--font-size-xs);
}
.cta-child {
  height: 44px;
  width: 209px;
  position: relative;
  border-radius: var(--br-7xs);
  background-color: var(--color-white);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.get-a-quote {
  position: relative;
  /*font-size: var(--font-size-3xs);*/
  font-size: var(--font-size-xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-300);
  text-align: left;
  display: inline-block;
  min-width: 62px;
  z-index: 1;
}
.box-bronze,
.cta,
.cta-wrapper {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.cta {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-sm) var(--padding-54xl);
  background-color: var(--color-white);
  border-radius: var(--br-7xs);
  justify-content: flex-start;
  white-space: nowrap;
  z-index: 1;
}
.cta:hover {
  background-color: var(--color-gainsboro);
  border: 1px solid var(--color-darkslateblue-100);
}
.box-bronze,
.cta-wrapper {
  justify-content: flex-end;
  padding: 0 var(--padding-mid) 0 var(--padding-xl);
  
}
.sub_cta{
    margin: 0 15px !important;
    padding: 0;
}
.box-bronze {
  width: 265px;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: var(--br-mini);
  border: 1px solid var(--color-darkslateblue-500);
  box-sizing: border-box;
  flex-shrink: 0;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: var(--padding-9xl) var(--padding-4xs) var(--padding-12xl)
    var(--padding-5xs);
  gap: var(--gap-8xl);
}
.border1,
.gold {
  position: relative;
}
.border1 {
  width: 265px;
  height: 430px;
  filter: drop-shadow(0 2.5px 10px #343f92);
  border-radius: var(--br-mini);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.gold {
  margin: 0;
  font-size: inherit;
  font-weight: 600;
  font-family: inherit;
  display: inline-block;
  min-width: 44px;
  z-index: 1;
}
.most-popular-child {
  height: 18px;
  width: 87px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-honeydew);
  border: 1px solid var(--color-aquamarine);
  box-sizing: border-box;
  display: none;
}
.most-popular1 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 62px;
  z-index: 1;
}
.most-popular {
  border-radius: var(--br-xl);
  background-color: var(--color-honeydew);
  border: 1px solid var(--color-aquamarine);
  flex-direction: row;
  padding: var(--padding-12xs) 11px var(--padding-11xs) var(--padding-sm);
  white-space: nowrap;
  z-index: 1;
}
.gold-parent,
.most-popular,
.most-popular-wrapper {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.most-popular-wrapper {
  flex-direction: column;
  padding: var(--padding-11xs) 0 0;
  font-size: 9px;
  color: #089b44;
}
.gold-parent {
  flex-direction: row;
  gap: var(--gap-5xs);
}
.div1 {
  position: relative;
  display: inline-block;
  min-width: 23.9px;
  white-space: nowrap;
  z-index: 1;
}
.frame-item {
  width: 26px;
  height: 1px;
  position: relative;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  z-index: 2;
  margin-top: -6px;
}
.frame-wrapper1,
.group {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.group {
  flex: 1;
}
.frame-wrapper1 {
  height: 20px;
  padding: var(--padding-8xs) 0 0;
  box-sizing: border-box;
}
.span1 {
  font-weight: 600;
}
.mo3 {
  font-size: var(--font-size-xs);
  font-weight: 500;
  color: var(--color-black);
}
.mo2 {
    align-items: center;
        display: flex;
  position: relative; 
  min-width: 78px;
  z-index: 1;
  font-size: var(--font-size-xl);
  color: var(--color-darkorange);
}
.off-button-item {
  height: 18px;
  width: 61px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  box-sizing: border-box;
  display: none;
}
.off1 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 49px;
  z-index: 1;
}
.off-button-container,
.off-button1 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.off-button1 {
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  flex-direction: row;
  padding: 0 var(--padding-7xs);
  white-space: nowrap;
  z-index: 1;
}
.off-button-container {
  flex-direction: column;
  padding: var(--padding-9xs) 0 0;
  color: var(--color-gray);
}
.frame-parent7 {
  flex-direction: row;
  justify-content: flex-start;
  gap: var(--gap-9xs);
  font-size: var(--font-size-xs);
}
.box-gold-inner,
.frame-parent6,
.frame-parent7 {
  display: flex;
  align-items: flex-start;
}
.frame-parent6 {
  flex-direction: column;
  justify-content: flex-start;
  gap: var(--gap-4xs);
}
.box-gold-inner {
  flex-direction: row;
  justify-content: flex-end;
  padding: 0 var(--padding-17xl) var(--padding-smi) var(--padding-19xl);
}
.frame-inner {
  position: absolute;
  width: calc(100% - 18px);
  top: 0;
  right: 9px;
  left: 9px;
  border-radius: var(--br-8xs);
  background-color: var(--color-ghostwhite);
  height: 54px;
  z-index: 1;
}
.accumsan-vel-purus1,
.ut-a-fringilla1 {
  margin: 0;
}
.accumsan-vel-purus-container1 {
  position: absolute;
  top: 13px;
  left: 0;
  font-weight: 300;
  display: inline-block;
  width: 246px;
  height: 24px;
  z-index: 2;
  
}
.accumsan-vel-purus-container1 p, .accumsan-vel-purus-container p, .accumsan-vel-purus-container2 p, .accumsan-vel-purus-container3 p{
    font-size: var(--font-size-3xs) !important;
}
.rectangle-group {
  align-self: stretch;
  height: 54px;
  position: relative;
  text-align: center;
  font-size: var(--font-size-3xs) !important;
}
.ture-mark-01-icon5 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper3 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.proin-vestibulum-lorem1 {
  position: relative;
  z-index: 1;
}
.frame-parent9 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon6 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper4 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-9xs) 0 0;
}
.variations-of-passages1 {
  position: relative;
  z-index: 1;
}
.frame-parent10 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon7 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper5 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.contrary-to-popular1 {
  position: relative;
  z-index: 1;
}
.frame-parent11 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon8 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper6 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.excepteur-sint-occaecat1 {
  position: relative;
  z-index: 1;
}
.frame-parent12 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon9 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper7 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.nemo-enim-ipsam1 {
  position: relative;
  z-index: 1;
}
.frame-parent13 {
  align-self: stretch;
  flex-direction: row;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.box-gold-child,
.frame-parent13,
.frame-parent8 {
  display: flex;
  align-items: flex-start;
}
.frame-parent8 {
  flex: 1;
  flex-direction: column;
  justify-content: flex-start;
  gap: var(--gap-5xs);
}
.box-gold-child {
  align-self: stretch;
  flex-direction: row;
  justify-content: flex-end;
  padding: 0 var(--padding-xl) var(--padding-lg) var(--padding-4xl);
  font-size: var(--font-size-xs);
}
.cta-item {
  height: 44px;
  width: 209px;
  position: relative;
  border-radius: var(--br-7xs);
  background-color: var(--color-darkslateblue-200);
  display: none;
}
.get-a-quote1 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-white);
  text-align: left;
  display: inline-block;
  min-width: 62px;
  z-index: 1;
}
.cta-container,
.cta1 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.cta1 {
  cursor: pointer;
  border: 0;
  padding: var(--padding-base) var(--padding-54xl);
  background-color: var(--color-darkslateblue-200);
  border-radius: var(--br-7xs);
  justify-content: flex-start;
  white-space: nowrap;
  z-index: 1;
}
.cta1:hover {
  background-color: var(--color-darkslateblue-100);
}
.cta-container {
  justify-content: flex-end;
  padding: 0 var(--padding-mid) 0 var(--padding-xl);
}
.border2,
.box-gold {
  width: 265px;
  border-radius: var(--br-mini);
  box-sizing: border-box;
}
.box-gold { 
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: var(--padding-9xl) var(--padding-4xs) var(--padding-12xl)
    var(--padding-5xs);
  gap: var(--gap-8xl);
}
.border2 {
  height: 430px;
  position: relative;
  border: 1px solid var(--color-darkslateblue-500);
  display: none;
}
.silver {
  margin: 0;
  font-size: inherit;
  font-weight: 600;
  font-family: inherit;
  display: inline-block;
  min-width: 51px;
  z-index: 1;
}
.div2,
.line-div,
.silver {
  position: relative;
}
.div2 {
  display: inline-block;
  min-width: 23.9px;
  white-space: nowrap;
  z-index: 1;
}
.line-div {
  width: 26px;
  height: 1px;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  z-index: 2;
  margin-top: -6px;
}
 
.frame-wrapper2 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
/*.container {*/
/*  flex: 1;*/
/*}*/
.frame-wrapper2 {
  height: 20px;
  padding: var(--padding-8xs) 0 0;
  box-sizing: border-box;
}
.span2 {
  font-weight: 600;
}
.mo5 {
  font-size: var(--font-size-xs);
  font-weight: 500;
  color: var(--color-black);
}
.mo4 {
  position: relative;
  display: inline-block;
  min-width: 78px;
  z-index: 1;
  font-size: var(--font-size-xl);
  color: var(--color-darkorange);
}
.frame-parent15 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-10xs);
}
.rectangle-div {
  height: 18px;
  width: 61px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  box-sizing: border-box;
  display: none;
}
.off2 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 49px;
  z-index: 2;
}
.frame-wrapper3,
.rectangle-container {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.rectangle-container {
  align-self: stretch;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  flex-direction: row;
  padding: 0 var(--padding-8xs);
  white-space: nowrap;
  z-index: 1;
}
.frame-wrapper3 {
  width: 61px;
  flex-direction: column;
  padding: var(--padding-11xs) 0 0;
  box-sizing: border-box;
  color: var(--color-gray);
}
.frame-parent14 {
  flex-direction: row;
  justify-content: flex-start;
  gap: var(--gap-smi);
  font-size: var(--font-size-xs);
}
.box-silver-inner,
.frame-parent14,
.silver-parent {
  display: flex;
  align-items: flex-start;
}
.silver-parent {
  flex-direction: column;
  justify-content: flex-start;
  gap: var(--gap-4xs);
}
.box-silver-inner {
  flex-direction: row;
  justify-content: flex-end;
  padding: 0 var(--padding-9xl) 0 var(--padding-19xl);
}
.bronze-feature-icon {
  position: absolute;
  width: calc(100% - 18px);
  top: 0;
  right: 9px;
  left: 9px;
  border-radius: var(--br-8xs);
  background-color: var(--color-ghostwhite);
  height: 54px;
  z-index: 1;
}
.accumsan-vel-purus2,
.ut-a-fringilla2 {
  margin: 0;
}
.accumsan-vel-purus-container2 {
  position: absolute;
  top: 13px;
  left: 0;
  font-weight: 300;
  display: inline-block;
  width: 246px;
  height: 24px;
  z-index: 2;
}
.bronze-feature-icon-parent {
  align-self: stretch;
  height: 54px;
  position: relative;
}
.ture-mark-01-icon10 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper8 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.proin-vestibulum-lorem2 {
  position: relative;
  z-index: 1;
}
.frame-parent18 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon11 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper9 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-9xs) 0 0;
}
.variations-of-passages2 {
  position: relative;
  z-index: 1;
}
.frame-parent19 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon12 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper10 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.contrary-to-popular2 {
  position: relative;
  z-index: 1;
}
.frame-parent20 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon13 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper11 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.excepteur-sint-occaecat2 {
  position: relative;
  z-index: 1;
}
.frame-parent21 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon14 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper12 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.nemo-enim-ipsam2 {
  position: relative;
  z-index: 1;
}
.frame-parent17,
.frame-parent22 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent22 {
  align-self: stretch;
  flex-direction: row;
  gap: var(--gap-8xs);
}
.frame-parent17 {
  flex: 1;
  flex-direction: column;
  gap: var(--gap-5xs);
}
.frame-parent16,
.frame-wrapper4 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 var(--padding-xl) 0 var(--padding-4xl);
  text-align: left;
  font-size: var(--font-size-xs);
}
.frame-parent16 {
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: 0 0 var(--padding-8xs);
  gap: var(--gap-8xl);
  text-align: center;
  font-size: var(--font-size-3xs);
}
.cta-inner {
  height: 44px;
  width: 209px;
  position: relative;
  border-radius: var(--br-7xs);
  background-color: var(--color-white);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.get-a-quote2 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-300);
  text-align: left;
  display: inline-block;
  min-width: 62px;
  z-index: 1;
}
.cta-frame,
.cta2 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.cta2 {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-sm) var(--padding-54xl);
  background-color: var(--color-white);
  border-radius: var(--br-7xs);
  justify-content: flex-start;
  white-space: nowrap;
  z-index: 1;
}
.cta2:hover,
.cta3:hover {
  background-color: var(--color-gainsboro);
  border: 1px solid var(--color-darkslateblue-100);
  box-sizing: border-box;
}
.cta-frame {
  justify-content: flex-end;
  padding: 0 var(--padding-mid) 0 var(--padding-xl);
}
.border3,
.box-silver {
  width: 265px;
  border-radius: var(--br-mini);
  border: 1px solid var(--color-darkslateblue-500);
  box-sizing: border-box;
}
.box-silver {
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: var(--padding-9xl) var(--padding-4xs) var(--padding-12xl)
    var(--padding-5xs);
  gap: 40px;
}
.border3 {
  height: 430px;
  position: relative;
  display: none;
}
.div3,
.platinum {
  position: relative;
  display: inline-block;
  z-index: 1;
}
.platinum {
  margin: 0;
  font-size: inherit;
  font-weight: 600;
  font-family: inherit;
  min-width: 86px;
}
.div3 {
  min-width: 23.9px;
  white-space: nowrap;
}
.frame-child1 {
  width: 26px;
  height: 1px;
  position: relative;
  border-top: 1px solid var(--color-black);
  box-sizing: border-box;
  z-index: 2;
  margin-top: -6px;
}
.frame-wrapper5,
.parent1 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
}
.parent1 {
  flex: 1;
}
.frame-wrapper5 {
  height: 20px;
  padding: var(--padding-8xs) 0 0;
  box-sizing: border-box;
}
.span3 {
  font-weight: 600;
}
.mo7 {
  font-size: var(--font-size-xs);
  font-weight: 500;
  color: var(--color-black);
}
.mo6 {
  position: relative;
  display: inline-block;
  min-width: 78px;
  z-index: 1;
  font-size: var(--font-size-xl);
  color: var(--color-darkorange);
}
.frame-parent24 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-10xs);
}
.frame-child2 {
  height: 18px;
  width: 61px;
  position: relative;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  box-sizing: border-box;
  display: none;
}
.off3 {
  position: relative;
  font-weight: 600;
  display: inline-block;
  min-width: 49px;
  z-index: 2;
}
.rectangle-parent1 {
  align-self: stretch;
  border-radius: var(--br-xl);
  background-color: var(--color-gold-200);
  border: 1px solid var(--color-gold-100);
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 0 var(--padding-8xs);
  white-space: nowrap;
  z-index: 1;
}
.frame-wrapper6 {
  width: 61px;
  flex-direction: column;
  padding: var(--padding-11xs) 0 0;
  box-sizing: border-box;
  color: var(--color-gray);
}
.frame-parent23,
.frame-wrapper6,
.platinum-parent {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent23 {
  flex-direction: row;
  gap: var(--gap-smi);
  font-size: var(--font-size-xs);
}
.platinum-parent {
  flex-direction: column;
  gap: var(--gap-4xs);
}
.box-platinum-inner {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 var(--padding-9xl) var(--padding-4xs) var(--padding-19xl);
}
.rectangle-input {
  border: 0;
  outline: 0;
  background-color: var(--color-ghostwhite);
  height: 54px;
  width: calc(100% - 18px);
  position: absolute;
  margin: 0 !important;
  right: 9px;
  bottom: -17px;
  left: 9px;
  border-radius: var(--br-8xs);
  z-index: 1;
}
.accumsan-vel-purus3,
.ut-a-fringilla3 {
  margin: 0;
}
.accumsan-vel-purus-container3 {
  flex: 1;
  position: relative;
  font-weight: 300;
  z-index: 2;
}
.rectangle-parent2 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  position: relative;
  text-align: center;
  font-size: var(--font-size-3xs);
}
.ture-mark-01-icon15 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper13 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.proin-vestibulum-lorem3 {
  position: relative;
  z-index: 1;
}
.frame-parent26 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon16 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper14 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-9xs) 0 0;
}
.variations-of-passages3 {
  position: relative;
  z-index: 1;
}
.frame-parent27 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon17 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper15 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.contrary-to-popular3 {
  position: relative;
  z-index: 1;
}
.frame-parent28 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon18 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper16 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.excepteur-sint-occaecat3 {
  position: relative;
  z-index: 1;
}
.frame-parent29 {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-start;
  gap: var(--gap-8xs);
}
.ture-mark-01-icon19 {
  width: 10px;
  height: 10px;
  position: relative;
  z-index: 1;
}
.ture-mark-01-wrapper17 {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: flex-start;
  padding: var(--padding-10xs) 0 0;
}
.nemo-enim-ipsam3 {
  position: relative;
  z-index: 1;
}
.frame-parent25,
.frame-parent30 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
}
.frame-parent30 {
  align-self: stretch;
  flex-direction: row;
  gap: var(--gap-8xs);
}
.frame-parent25 {
  flex: 1;
  flex-direction: column;
  gap: var(--gap-5xs);
}
.box-platinum-child {
  align-self: stretch;
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: flex-end;
  padding: 0 var(--padding-xl) 0 var(--padding-4xl);
  font-size: var(--font-size-xs);
}
.cta-child1 {
  height: 44px;
  width: 209px;
  position: relative;
  border-radius: var(--br-7xs);
  background-color: var(--color-white);
  border: 1px solid var(--color-darkslateblue-200);
  box-sizing: border-box;
  display: none;
}
.get-a-quote3 {
  position: relative;
  font-size: var(--font-size-3xs);
  font-weight: 600;
  font-family: var(--font-montserrat);
  color: var(--color-darkslateblue-300);
  text-align: left;
  display: inline-block;
  min-width: 62px;
  z-index: 1;
}
.cta-wrapper1,
.cta3 {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
}
.cta3 {
  cursor: pointer;
  border: 1px solid var(--color-darkslateblue-200);
  padding: var(--padding-sm) var(--padding-54xl);
  background-color: var(--color-white);
  border-radius: var(--br-7xs);
  justify-content: flex-start;
  white-space: nowrap;
  z-index: 1;
}
.cta-wrapper1 {
  justify-content: flex-end;
  padding: 0 var(--padding-mid) 0 var(--padding-xl);
}
.box-platinum {
  width: 265px;
  border-radius: var(--br-mini);
  border: 1px solid var(--color-darkslateblue-500);
  box-sizing: border-box;
  flex-shrink: 0;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: flex-start;
  padding: var(--padding-9xl) var(--padding-4xs) var(--padding-12xl)
    var(--padding-5xs);
  gap: 44px;
}
.box-bronze-parent,
.macbook-air-1 {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  padding: 20px 0px;
}
.box-bronze-parent {
  width: 100%;
  justify-content: center;
  overflow-x: auto;
  flex-direction: row;
  gap: 35.3px;
  max-width: 100%;
  text-align: left;
  font-size: var(--font-size-lg);
  color: var(--color-black);
  font-family: var(--font-montserrat);
}
.new_box:hover{
    box-shadow: 0 2.5px 10px 0.1px #343f92;
    border: 1px solid var(--color-darkslateblue-200);
}
.new_box:hover .cta{
    background-color: #181e4e;
    
}
.new_box:hover .cta .get-a-quote{
    color:#fff !important;
}
.newBorder{
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    border: 1px solid var(--color-darkslateblue-500);
}
.boxShodow{
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
}
.newActive{
    background-color: var(--color-ghostwhite);
    border-radius: var(--br-8xs);
    padding: var(--padding-5xs) var(--padding-base);
}
.duration:hover{
    /*background-color: var(--color-ghostwhite);*/
    background-color: #facc15;
    border-radius: var(--br-8xs); 
    padding: var(--padding-5xs) var(--padding-base);
}
.duration{
    text-align:center !important;
    padding: var(--padding-5xs) var(--padding-base);
        line-height: 15px !important;
}
.macbook-air-1 {
  width: 100%;
  position: relative; 
  /*box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);*/
  background-color: var(--color-white);
  overflow: hidden;
  flex-direction: column;
  /*padding: 67px 54px 194px 60px;*/
  box-sizing: border-box;
  gap: 32px;
  line-height: normal;
  letter-spacing: normal;
}
@media screen and (max-width: 750px) {
  .digital-marketing-packages {
    font-size: 24px;
  }
}
@media screen and (max-width: 675px) {
  .box-bronze-parent {
    gap: 18px;
  }
  .macbook-air-1 {
    gap: 16px;
    padding-left: 30px;
    padding-right: 27px;
    box-sizing: border-box;
  }
}
@media screen and (max-width: 450px) {
  .digital-marketing-packages {
    font-size: var(--font-size-lg);
  }
  .subscription-options {
    flex-wrap: wrap;
  }
  .box-bronze,
  .box-gold,
  .box-platinum,
  .box-silver {
    padding-top: var(--padding-xl);
    padding-bottom: var(--padding-xl);
    box-sizing: border-box;
    margin-bottom: 15px;
  }
  .box-silver {
    gap: var(--gap-xl);
  }
  .box-platinum {
    gap: 22px;
  }
}
.display_none{
    display:none !important;
}
.border-new{
    border: 1px solid lightgrey;
    padding: 5px;
    border-radius: 10px;
}
.border-new li{
    padding:0 3px;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
    /*color: #000 !important;*/
    /*background-color: #eef0fd !important;*/
        color: #fff !important;
    background-color: #192052 !important;
}
.sub_title{
    font-size: var(--font-size-3xs-1);
    
}
@media(max-width:767px){
    .price_card_figma .tab-pane{
        flex-direction: column;
        align-items: center;
    }
}
</style>

<div class="innerbanner-area">  
    <div class="macbook-air-1">
        <section class="container">
            <div class="row"> 
            <ul class="nav nav-pills justify-content-center" id="exTab1" role="tablist">
                <div class="d-flex mb-5 ">
                    <li class="nav-item">
                        <a href="#a1" id="ex2-tab-1" class="nav-link text-black packages-box active duration new_click_new" role="tab" aria-controls="a1" aria-selected="false" data-bs-toggle="tab">Month
                            <br>
                            <span class="sub_title">1 Month</span>
                        </a></li>
                    <li class="nav-item">
                        <a href="#a2" id="ex2-tab-2" class="nav-link text-black packages-box duration new_click_new" role="tab" data-bs-toggle="tab" aria-controls="a2" aria-selected="false">Quarterly
                            <br>
                            <span class="sub_title">3 Month</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#a3" id="ex2-tab-3" class="nav-link text-black packages-box duration new_click_new" role="tab" data-bs-toggle="tab" aria-controls="a3" aria-selected="false">Half Yearly
                            <br>
                            <span class="sub_title">6 Month</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#a4" id="ex2-tab-4" class="nav-link text-black packages-box duration new_click_new" role="tab" data-bs-toggle="tab" aria-controls="a4" aria-selected="false">Yearly
                            <br>
                            <span class="sub_title">12 Month</span>
                        </a>
                    </li>
                </div>
            </ul>

    <div class="price_card_figma tab-content clearfix">
          
        <div class="tab-pane  d-flex justify-content-between fade show active" id="a1" aria-labelledby="ex2-tab-1" role="tabpanel">
            @if(!empty($data_new))
            @foreach($data_new as $key => $val)  
                <div class="box-bronze new_box">
                        <div class="border"></div>
                        <div class="box-bronze-inner">
                            <div class="bronze-parent">
                                <div class="gold-parent">
                                    <h3 class="bronze">{{ ucfirst($val['plan_name']) }}</h3>
                                    @if($val['most_popular'] != 0)
                                        <div class="most-popular-wrapper">
                                            <div class="most-popular">
                                                <div class="most-popular-child"></div>
                                                <div class="most-popular1">Most popular</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="frame-group">
                                    <div class="frame-wrapper">
                                        <div class="parent">
                                            <div class="div">₹{{ $val['main_price'] }}</div>
                                            <div class="mothly-price-dividers"></div>
                                        </div>
                                    </div>
                                    <div class="mo">
                                        <span class="span">₹{{ $val['discount_price'] }}</span>
                                        <span class="mo1">/mo</span>
                                    </div>
                                    <div class="off-button-wrapper">
                                        <div class="off-button">
                                            <div class="off-button-child"></div>
                                            <div class="off">{{ $val['percentage'] }}% Off</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($small_description as $small => $smdes)
                        @if(ucfirst($val['plan_name']) == ucfirst($smdes->plan_name))
                        <div class="rectangle-parent">
                            <div class="frame-child">
                                <div class="accumsan-vel-purus-container">
                                    <p class="accumsan-vel-purus">
                                        
                                            {{$smdes->small_description }}
                                        
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-bronze-child">
                            <div class="frame-container">
                                @php $features = json_decode($smdes->small_features); @endphp 
                                @foreach($features as $fea)
                                    <div class="frame-parent1">
                                        <div class="ture-mark-01-wrapper">
                                            <img class="ture-mark-01-icon" loading="lazy" alt="" src="./public/ture-mark-01.svg" />
                                        </div>
                                        <div class="proin-vestibulum-lorem">
                                            {{ $fea }}
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="cta-wrapper sub_cta">
                            <div class="cta">
                                <div class="cta-child"></div>
                                <a href="{{ route('purchase', [
                                    'plan' => $val['plan_name'], 
                                    'duration' => $val['duration_id'], 
                                    'service_id' => $val['service_type'],
                                    'id'=> $val['id']
                                ]) }}">
                                    <div class="get-a-quote">Get a Quote</div>
                                </a> 
                            </div>
                        </div>
                    </div>
            @endforeach
            @endif
        </div> 
        <div class="tab-pane d-flex justify-content-between fade hide display_none" id="a2" aria-labelledby="ex2-tab-2" role="tabpanel">
            @if(!empty($data1))
            @foreach($data1 as $key1 => $val1) 
            <div class="box-bronze new_box">
                <div class="border"></div>
                <div class="box-bronze-inner">
                    <div class="bronze-parent">
                        <div class="gold-parent">
                            <h3 class="bronze">{{ ucfirst($val1['plan_name']) }}</h3>
                            @if($val1['most_popular'] != 0) 
                            <div class="most-popular-wrapper">
                                <div class="most-popular">
                                    <div class="most-popular-child"></div>
                                    <div class="most-popular1">Most popular</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="frame-group">
                            <div class="frame-wrapper">
                                <div class="parent">
                                    <div class="div">₹{{ $val1['main_price'] }}</div>
                                    <div class="mothly-price-dividers"></div>
                                </div>
                            </div>
                            <div class="mo">
                                <span class="span">₹{{ $val1['discount_price'] }}</span>
                                <span class="mo1">/mo</span>
                            </div>
                            <div class="off-button-wrapper">
                                <div class="off-button">
                                    <div class="off-button-child"></div>
                                    <div class="off">{{ $val1['percentage'] }}% Off</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @foreach($small_description as $small => $smdes)
                        @if(ucfirst($val1['plan_name']) == ucfirst($smdes->plan_name))
                        <div class="rectangle-parent">
                            <div class="frame-child">
                                <div class="accumsan-vel-purus-container">
                                    <p class="accumsan-vel-purus">
                                        
                                            {{$smdes->small_description }}
                                        
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-bronze-child">
                            <div class="frame-container">
                                @php $features = json_decode($smdes->small_features); @endphp 
                                @foreach($features as $fea)
                                    <div class="frame-parent1">
                                        <div class="ture-mark-01-wrapper">
                                            <img class="ture-mark-01-icon" loading="lazy" alt="" src="./public/ture-mark-01.svg" />
                                        </div>
                                        <div class="proin-vestibulum-lorem">
                                            {{ $fea }}
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                <div class="cta-wrapper sub_cta">
                    <div class="cta">
                        <div class="cta-child"></div>
                        <a href="{{ route('purchase', [
                                    'plan' => $val1['plan_name'], 
                                    'duration' => $val1['duration_id'], 
                                    'service_id' => $val1['service_type'],
                                    'id'=> $val1['id']
                                ]) }}">
                            <div class="get-a-quote">Get a Quote</div></a>
                    </div>
                </div>
            </div>
            @endforeach 
            @endif
        </div>
        <div class="tab-pane  d-flex justify-content-between fade hide display_none" id="a3" aria-labelledby="ex2-tab-3" role="tabpanel">
            @if(!empty($data2))
            @foreach($data2 as $key2 => $val2)  
                <div class="box-bronze new_box">
                        <div class="border"></div>
                        <div class="box-bronze-inner">
                            <div class="bronze-parent">
                                <div class="gold-parent">
                                    <h3 class="bronze">{{ ucfirst($val2['plan_name']) }}</h3>
                                    @if($val2['most_popular'] != 0)
                                        <div class="most-popular-wrapper">
                                            <div class="most-popular">
                                                <div class="most-popular-child"></div>
                                                <div class="most-popular1">Most popular</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="frame-group">
                                    <div class="frame-wrapper">
                                        <div class="parent">
                                            <div class="div">₹{{ $val2['main_price'] }}</div>
                                            <div class="mothly-price-dividers"></div>
                                        </div>
                                    </div>
                                    <div class="mo">
                                        <span class="span">₹{{ $val2['discount_price'] }}</span>
                                        <span class="mo1">/mo</span>
                                    </div>
                                    <div class="off-button-wrapper">
                                        <div class="off-button">
                                            <div class="off-button-child"></div>
                                            <div class="off">{{ $val2['percentage'] }}% Off</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($small_description as $small => $smdes)
                        @if(ucfirst($val2['plan_name']) == ucfirst($smdes->plan_name))
                        <div class="rectangle-parent">
                            <div class="frame-child">
                                <div class="accumsan-vel-purus-container">
                                    <p class="accumsan-vel-purus">    {{$smdes->small_description }}
                                        
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-bronze-child">
                            <div class="frame-container">
                                @php $features = json_decode($smdes->small_features); @endphp 
                                @foreach($features as $fea)
                                    <div class="frame-parent1">
                                        <div class="ture-mark-01-wrapper">
                                            <img class="ture-mark-01-icon" loading="lazy" alt="" src="./public/ture-mark-01.svg" />
                                        </div>
                                        <div class="proin-vestibulum-lorem">
                                            {{ $fea }}
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <div class="cta-wrapper sub_cta">
                            <div class="cta">
                                <div class="cta-child"></div>
                                <a href="{{ route('purchase', [
                                    'plan' => $val2['plan_name'], 
                                    'duration' => $val2['duration_id'], 
                                    'service_id' => $val2['service_type'],
                                    'id'=> $val2['id']
                                ]) }}">
                                    <div class="get-a-quote">Get a Quote</div></a>
                            </div>
                        </div>
                    </div>
            @endforeach 
            @endif
        </div>
        <div class="tab-pane  d-flex justify-content-between fade hide display_none" id="a4" aria-labelledby="ex2-tab-4" role="tabpanel">
            @if(!empty($data3))
            @foreach($data3 as $key3 => $val3)
            <div class="box-bronze new_box">
                <div class="border"></div>
                <div class="box-bronze-inner">
                    <div class="bronze-parent">
                        <div class="gold-parent">
                            <h3 class="bronze">{{ ucfirst($val3['plan_name']) }}</h3>
                            @if($val3['most_popular'] != 0)
                            
                            <div class="most-popular-wrapper">
                                <div class="most-popular">
                                    <div class="most-popular-child"></div>
                                    <div class="most-popular1">Most popular</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="frame-group">
                            <div class="frame-wrapper">
                                <div class="parent">
                                    <div class="div">₹{{ $val3['main_price'] }}</div>
                                    <div class="mothly-price-dividers"></div>
                                </div>
                            </div>
                            <div class="mo">
                                <span class="span">₹{{ $val3['discount_price'] }}</span>
                                <span class="mo1">/mo</span>
                            </div>
                            <div class="off-button-wrapper">
                                <div class="off-button">
                                    <div class="off-button-child"></div>
                                    <div class="off">{{ $val3['percentage'] }}% Off</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @foreach($small_description as $small => $smdes)  
                        @if(ucfirst($val3['plan_name']) == ucfirst($smdes->plan_name))
                        <div class="rectangle-parent">
                            <div class="frame-child">
                                <div class="accumsan-vel-purus-container">
                                    <p class="accumsan-vel-purus">
                                        
                                            {{$smdes->small_description }}
                                        
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="box-bronze-child">
                            <div class="frame-container">
                                @php $features = json_decode($smdes->small_features); @endphp 
                                @foreach($features as $fea)
                                    <div class="frame-parent1">
                                        <div class="ture-mark-01-wrapper">
                                            <img class="ture-mark-01-icon" loading="lazy" alt="" src="./public/ture-mark-01.svg" />
                                        </div>
                                        <div class="proin-vestibulum-lorem">
                                            {{ $fea }}
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endforeach
                <div class="cta-wrapper sub_cta">
                    <div class="cta">
                        <div class="cta-child"></div>
                        <a href="{{ route('purchase', [
                                    'plan' => $val3['plan_name'], 
                                    'duration' => $val3['duration_id'], 
                                    'service_id' => $val3['service_type'],
                                    'id'=> $val3['id']
                                    
                                ]) }}">
                            
                            <div class="get-a-quote">Get a Quote</div></a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div> 
    </div> 
        </section> 
    </div> 
</div>
<div class="text-center">
  <a href="#feature" class="btn-primary rounded">Compare Plans</a>
</div>
