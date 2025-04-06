namespace SzallodaManagerForm.ItemPanels
{
    internal class ItemPanel : Panel
    {
        public int ItemID { get; private set; }
        public ItemPanel(Panel parent, int verticalPadding = 10)
        {
            ResizePanel(parent.ClientSize); 
            Location = new Point(10, (60 + verticalPadding) * parent.Controls.Count + verticalPadding);
            BackColor = Color.Aqua;
            Visible = true;
        }

        public void ResizePanel(Size parentSize)
        {
            Size = new Size(Convert.ToInt32(Math.Floor(parentSize.Width * 0.95)), 60);
            AlignElementsHorizontally();
        }

        public void PositionElemenet(Control control, int position)
        {
            control.Location = new Point(position, (Size.Height - control.Size.Height) / 2);
        }

        public virtual void AlignElementsHorizontally(int sidePadding = 20)
        {
            var controls = Controls.Cast<Control>().ToList();

            int width = Size.Width - sidePadding * 2;
            int totalWidth = controls.Sum(c => c.Size.Width);
            int gapSize = (int)Math.Round((double)(Size.Width - sidePadding * 2 - totalWidth) / controls.Count);
            int currentX = sidePadding;

            foreach (Control c in controls)
            {
                PositionElemenet(c, currentX);
                currentX = currentX + gapSize + c.Size.Width;
            }
        }

        public List<int> GetControlPositions()
        {
            return this.Controls.Cast<Control>().Select(c => c.Location.X + c.ClientSize.Width/2).ToList();
        }
    }
}
